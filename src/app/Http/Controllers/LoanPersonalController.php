<?php

namespace App\Http\Controllers;

require_once(__DIR__.'/../../../vendor/autoload.php');

use Illuminate\Http\Request;

use DocuSign\eSign;
use DocuSign\eSign\Configuration;
use DocuSign\eSign\ApiClient;
use DocuSign\eSign\Api\EnvelopesApi;
use DocuSign\eSign\Api\EnvelopesApi\CreateEnvelopeOptions;
use DocuSign\eSign\Api\UsersApi;
use DocuSign\eSign\Model\TemplateRole;
use DocuSign\eSign\Model\EnvelopeDefinition;
use DocuSign\eSign\Model\Document;
use DocuSign\eSign\Model\Signer;
use DocuSign\eSign\Model\Recipients;
use DocuSign\eSign\Model\RecipientPhoneAuthentication;
use DocuSign\eSign\Model\Tabs;
use DocuSign\eSign\Model\RecipientViewRequest;

use \Firebase\JWT\JWT;

class LoanPersonalController extends Controller
{
    public function init() {
        $signing_location_options = ['embedded', 'remote'];
        $authentication_options = ['none','phone','idcheck'];

        return view('loan-personal', compact('signing_location_options','authentication_options'));
    }

    public function form_post(Request $request) {

        $tokenUrl = "/oauth/token";
        $userInfoUrl = "/oauth/userinfo";

        $integratorKey = config('loanco.docusign_integratorkey');   //iss
        $sysadminuserid = config('loanco.docusign_userguid');       //sub
        $host = config('loanco.docusign_host');                     //aud (account.docusign.com or account-d.docusign.com)
        $scope = "signature impersonation";                         //scope

        $privateKey = file_get_contents('../keys/private.pem');
        $current_time = time();
        $expiry = $current_time + (60 * 60);
        
        $token = array(
            "iss" => $integratorKey,
            "sub" => $sysadminuserid,
            "aud" => $host,
            "iat" => $current_time,
            "exp" => $expiry,
            "scope" => $scope
        );
        
        $jwt = JWT::encode($token, $privateKey, 'RS256');

        try {
            //*** STEP 1 - Get Access Token by JWT of SysAdmin credentials
            $client = new \GuzzleHttp\Client();
            $response = $client->request('POST', "https://${host}${tokenUrl}", [
                'headers' => [
                    'Content-Type' => 'application/x-www-form-urlencoded'
                ],
                'body' => 'grant_type=urn:ietf:params:oauth:grant-type:jwt-bearer&assertion='.$jwt
            ]);
            $body = (string)$response->getBody();
            
            $accessToken = json_decode($body)->{'access_token'};

            // Obtain the selected account's base_uri
            $response = $client->request('GET', "https://${host}${userInfoUrl}", [
                'headers' => [
                    'Authorization' => 'Bearer '.$accessToken
                ]
            ]);
            $body = (string)$response->getBody();
            $baseUri = json_decode($body)->{'accounts'}[0]->{'base_uri'};
            $basePath = $baseUri.'/restapi';
            $accountId = json_decode($body)->{'accounts'}[0]->{'account_id'};

            /***  To Get Actual User's Access Token */
            /*
             * 1. $usersApi = new UsersApi();
             * 2. $loginOptions = new \DocuSign\eSign\Api\UsersApi\LoginOptions();
             * 3. $loginOptions->setEmail('<<ACTUAL USER'S EMAIL>>);
             * 4. $response = $usersApi->callList($accountId, $loginOptions);
             * 5. $body = (string)$response->getBody();
             * 5. $actualUserId = json_decode($body)->{'users'}[0]->{'userId'};
             * 6. Create JWT and get Access Token for actual user
             * */

            // create configuration object and configure custom auth header
            $config = new Configuration();
            $config->setHost($basePath);
            $config->addDefaultHeader("Authorization", 'Bearer '.$accessToken);

            $apiClient = new ApiClient($config);

            // create an envelope that will store the document(s), field(s), and recipient(s)
            $envDef = new EnvelopeDefinition();
            $envDef->setEmailSubject("Personal Loan Application");
            $envDef->setEmailBlurb("Please sign the Loan application to start the application process.");

            // add a document to the envelope
            $doc = new Document();
            $file1Base64 = base64_encode(file_get_contents('../pdfs/LoanPersonal.docx'));
            $doc->setDocumentBase64($file1Base64);
            $doc->setName('Document'); // can be different from actual file name
            $doc->setFileExtension('docx');
            $doc->setDocumentId('1'); // hardcode so we can easily refer to this document later

            $envDef->setDocuments(array($doc));

            // Recipient
            $signer = new Signer();
            $signer->setEmail($_POST["inputEmail"]);
            $signer->setName($_POST["inputFirstName"].' '.$_POST["inputLastName"]);
            $signer->setRecipientId("1");
            if($_POST["inputSigningLocation"] == 'embedded'){
                $signer->setClientUserId('1001');
            }
            if(isset($_POST["inputAuthentication"]) && $_POST["inputAuthentication"] == 'phone'){
                // Not enabled in demo
                $signer->setRequireIdLookup(true);
                $signer->setIdCheckConfigurationName("Phone Auth $");

                $phoneAuth = new RecipientPhoneAuthentication();
                $phoneAuth->setSenderProvidedNumbers(array($_POST["inputPhone"]));
                $phoneAuth->setRecipMayProvideNumber(true);
                $phoneAuth->setRecordVoicePrint(true);
            }
            if($_POST["inputAccessCode"] && strlen($_POST["inputAccessCode"]) > 0){
                $signer->setAccessCode($_POST["inputAccessCode"]);
            }

            // FullName
            $fullName = [
                'documentId' => '1',
                'recipientId' => '1',
                'anchorString' => 'Name',
                'anchorXOffset' => '58',
                'anchorYOffset' => '-2',
                'locked' => 'false'
            ];

            // Email
            $email = [
                'documentId' => '1',
                'recipientId'=>'1',
                'name'=>'Email',
                'tabLabel'=>'Email',
                'anchorString'=>'Email',
                'anchorXOffset'=>'55',
                'anchorYOffset'=>'-2',
                'value'=>$_POST["inputEmail"]
            ];

            // Phone
            $textPhone = [
                'documentId' => '1',
                'recipientId'=>'1',
                'name'=>'Phone',
                'tabLabel'=>'Phone',
                'anchorString'=>'Phone',
                'anchorXOffset'=>'65',
                'anchorYOffset'=>'-2',
                'value'=>$_POST["inputPhone"],
                'width'=>'90',
                'locked'=>'false'
            ];

            // Address Line 1
            $textAddr1 = [
                'documentId' => '1',
                'recipientId'=>'1',
                'name'=>'AddressLine1',
                'tabLabel'=>'AddressLine1',
                'anchorString'=>'Address',
                'anchorXOffset'=>'80',
                'anchorYOffset'=>'-2',
                'value'=>$_POST['inputAddress1'],
                'locked'=>'false'
            ];

            // Address Line 2
            $textAddr2 = [
                'documentId' => '1',
                'recipientId'=>'1',
                'name'=>'AddressLine2',
                'tabLabel'=>'AddressLine2',
                'anchorString'=>'Address',
                'anchorXOffset'=>'80',
                'anchorYOffset'=>'20',
                'value'=>$_POST['inputAddress2'],
                'required'=>'false',
                'locked'=>'false'
            ];

            // Address city/state/zip
            $textAddress = [
                'documentId' => '1',
                'recipientId'=>'1',
                'name'=>'AddressCityStateZip',
                'tabLabel'=>'AddressCityStateZip',
                'anchorString'=>'Address',
                'anchorXOffset'=>'80',
                'anchorYOffset'=>'40',
                'value'=>$_POST['inputCity'].', '.$_POST['inputState'].' '. $_POST['inputZip'],
                'locked'=>'false'
            ];

            // Amount
            $numberAmount = [
                'documentId' => '1',
                'recipientId'=>'1',
                'name'=>'Amount',
                'tabLabel'=>'Amount',
                'anchorString'=>'Amount',
                'anchorXOffset'=>'75',
                'anchorYOffset'=>'-2',
                'width'=>'90',
                'locked'=>'false',
                'value'=>(isset($_POST['inputLoanAmount']) ? $_POST['inputLoanAmount']: null)
            ];

            // Payment payback period (months) 
            $numberPeriod = [
                'documentId' => '1',
                'recipientId'=>'1',
                'name'=>'PaymentDuration',
                'tabLabel'=>'PaymentDuration',
                'anchorString'=>'Payment Duration',
                'anchorXOffset'=>'150',
                'anchorYOffset'=>'-2',
                'width'=>'15',
                'locked'=>'false',
                'value'=>(isset($_POST['inputLoanLength']) ? $_POST['inputLoanLength']: null)
            ];

            // Monthly payments (calculated field)
            $formula = [
                'documentId' => '1',
                'recipientId'=>'1',
                'name'=>'MonthlyPayment',
                'tabLabel'=>'MonthlyPayment',
                'anchorString'=>'Monthly Payment',
                'anchorXOffset'=>'180',
                'anchorYOffset'=>'-2',
                'formula'=>'[Amount]/[PaymentDuration]'
            ];

            // SignHere
            $signHere = [
                'documentId' => '1',
                'recipientId'=>'1',
                'anchorString'=>'DocuSign API rocks',
                'anchorXOffset'=>'10',
                'anchorYOffset'=>'60'
            ];

            $tabs = new Tabs();
            $tabs->setTextTabs(array($textPhone,$textAddr1,$textAddr2,$textAddress));
            $tabs->setNumberTabs(array($numberAmount,$numberPeriod));
            $tabs->setFormulaTabs(array($formula));
            $tabs->setEmailTabs(array($email));
            $tabs->setFullNameTabs(array($fullName));
            $tabs->setSignHereTabs(array($signHere));

            //$tabs->setInitialHereTabs('initialHere'=>[]);
            //$tabs->setDateSignedTabs('dateSigned'=>[]);
            //$tabs->setInitialHereTabs(null);
            //$tabs->setDateSignedTabs(null);

            $signer->setTabs($tabs);

            // add recipients (in this case a single signer) to the envelope
            $envDef->setRecipients(new Recipients());
            $envDef->getRecipients()->setSigners(array($signer));

            // send the envelope by setting |status| to "sent". To save as a draft set to "created"
            // - note that the envelope will only be 'sent' when it reaches the DocuSign server with the 'sent' status (not in the following call)
            $envDef->setStatus('sent');

            // instantiate a new EnvelopesApi object
            $envelopesApi = new EnvelopesApi($apiClient);

            // optional envelope parameters
            $envOptions = new CreateEnvelopeOptions();
            $envOptions->setCdseMode(null);
            $envOptions->setMergeRolesOnDraft(null);
            
            // create and send the envelope (aka signature request)
            $envelop_summary = $envelopesApi->createEnvelope($accountId, $envDef, $envOptions);

            if($_POST["inputSigningLocation"] == 'embedded'){

                $envelopeId = "";
                if(!empty($envelop_summary))
                {
                    $envelopeId = json_decode($envelop_summary)->{'envelopeId'};
                }

                if (isset($envelopeId)) {
                    
                    $recipientViewRequest = new RecipientViewRequest();
                    $recipientViewRequest->setReturnUrl('http://localhost:8080/sign/return');
                    $recipientViewRequest->setAuthenticationMethod('None');
                    $recipientViewRequest->setUserName($_POST["inputFirstName"].' '.$_POST["inputLastName"]);
                    $recipientViewRequest->setEmail($_POST["inputEmail"]);
                    $recipientViewRequest->setClientUserId('1001');

                    $response = $envelopesApi->createRecipientView($accountId, $envelopeId, $recipientViewRequest);
                    
                    var_dump(json_decode($response));

                    if(!empty($response))
                    {
                        return redirect(json_decode($response)->{'url'});
                    }
                };

            } else {
                $waitingForRemote = true;
                return view('signingreturn')->with(['event' => 'waitingForRemote', 'msg' => '署名リクエストを受信者に送信しました。', 'waitingForRemote' => 'waitingForRemote', 'nextUrl' => '']);
            }

        }
        catch (DocuSign\eSign\ApiException $ex)
        {
            echo "Exception: " . $ex->getMessage() . "\n";
        }
    }


}
