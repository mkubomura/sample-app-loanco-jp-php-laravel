
@extends('layouts.master_loanco')
@section('title', 'LoanCo - 個人ローン申し込み')

@section('body')
<div class="container">

  <div id="error-why"></div>

  <div class="row">
    <div class="col-sm-5 col-sm-offset-1">

      <h2 class="text-center">
        個人ローン申し込み
      </h2>

      <hr />

      <form id="mainForm1" data-toggle="validator" method="POST" action="/loan/personal">
        {{ csrf_field() }}
        <div class="form-group">
          <label for="inputLastName">姓</label>
          <input type="text" class="form-control" id="inputLastName" name="inputLastName" placeholder="" required value="佐藤">
          <div class="help-block with-errors"></div>
        </div>
        <div class="form-group">
          <label for="inputFirstName">名</label>
          <input type="text" class="form-control" id="inputFirstName" name="inputFirstName" placeholder="" required value="達也">
          <div class="help-block with-errors"></div>
        </div>

        <div class="form-group">
          <label for="inputEmail">メールアドレス</label>
          <input type="email" class="form-control" id="inputEmail" name="inputEmail" placeholder="" required value="{{config('loanco.default_email')}}">
          <div class="help-block with-errors"></div>
        </div>

        <div class="row">

          <div class="col-sm-4">
            <div class="form-group">
              <label for="inputAddress1Name">郵便番号</label>
              <input type="text" class="form-control" id="inputZip" name="inputZip" placeholder="" required value="107-0051" maxlength="8">
              <div class="help-block with-errors"></div>
            </div>            
          </div>

          <div class="col-sm-4">

            <div class="form-group">
              <label for="inputState">都道府県</label>
              <select class="form-control" id="inputState" name="inputState" required>
                <option value="北海道">北海道</option>
                <option value="青森県">青森県</option>
                <option value="岩手県">岩手県</option>
                <option value="宮城県">宮城県</option>
                <option value="秋田県">秋田県</option>
                <option value="山形県">山形県</option>
                <option value="福島県">福島県</option>
                <option value="茨城県">茨城県</option>
                <option value="栃木県">栃木県</option>
                <option value="群馬県">群馬県</option>
                <option value="埼玉県">埼玉県</option>
                <option value="千葉県">千葉県</option>
                <option value="東京都"  selected="">東京都</option>
                <option value="神奈川県">神奈川県</option>
                <option value="新潟県">新潟県</option>
                <option value="富山県">富山県</option>
                <option value="石川県">石川県</option>
                <option value="福井県">福井県</option>
                <option value="山梨県">山梨県</option>
                <option value="長野県">長野県</option>
                <option value="岐阜県">岐阜県</option>
                <option value="静岡県">静岡県</option>
                <option value="愛知県">愛知県</option>
                <option value="三重県">三重県</option>
                <option value="滋賀県">滋賀県</option>
                <option value="京都府">京都府</option>
                <option value="大阪府">大阪府</option>
                <option value="兵庫県">兵庫県</option>
                <option value="奈良県">奈良県</option>
                <option value="和歌山県">和歌山県</option>
                <option value="鳥取県">鳥取県</option>
                <option value="島根県">島根県</option>
                <option value="岡山県">岡山県</option>
                <option value="広島県">広島県</option>
                <option value="山口県">山口県</option>
                <option value="徳島県">徳島県</option>
                <option value="香川県">香川県</option>
                <option value="愛媛県">愛媛県</option>
                <option value="高知県">高知県</option>
                <option value="福岡県">福岡県</option>
                <option value="佐賀県">佐賀県</option>
                <option value="長崎県">長崎県</option>
                <option value="熊本県">熊本県</option>
                <option value="大分県">大分県</option>
                <option value="宮崎県">宮崎県</option>
                <option value="鹿児島県">鹿児島県</option>
                <option value="沖縄県">沖縄県</option>
              </select>
              <div class="help-block with-errors"></div>
            </div>
          </div>

        </div>

        <div class="form-group">
          <label for="inputAddress1Name">市区町村</label>
          <input type="text" class="form-control" id="inputCity" name="inputCity" placeholder="" data-error="市区町村を入力して下さい" required value="港区">
          <div class="help-block with-errors"></div>
        </div>      

        <div class="form-group">
          <label for="inputAddress1Name">住所1</label>
          <input type="text" class="form-control" id="inputAddress1" name="inputAddress1" placeholder="" required value="元赤坂1-2-7">
          <div class="help-block with-errors"></div>
        </div>
        <div class="form-group">
          <label for="inputAddress1Name">住所2</label>
          <input type="text" class="form-control" id="inputAddress2" name="inputAddress2" placeholder="" value="赤坂Kタワー4階">
        </div>

        <div class="form-group">
          <label for="inputPhone">電話番号</label>
          <input type="tel" class="form-control" id="inputPhone" name="inputPhone" placeholder="">
          <div class="help-block with-errors"></div>
        </div>
        <p>
          <span class="collapseTrigger collapsed" data-toggle="collapse" data-target="#collapseAdvanced" aria-expanded="false" aria-controls="collapseAdvanced">
            <i class="fa fa-plus-square-o show-on-collapsed" aria-hidden="true"></i><i class="fa fa-minus-square-o show-on-open" aria-hidden="  true"></i> 追加情報
          </span>
        </p>
        <div class="collapse" id="collapseAdvanced">

          <div class="form-group">
            <label for="input">署名方法</label>
            <select class="form-control" name="inputSigningLocation">
                @foreach($signing_location_options as $soption)
                <option value="{{ $soption }}" @if(old('inputSigningLocation') == $soption) selected @endif>{{$soption}}</option>
                @endforeach
            </select>

            <span class="help-block">
              本画面内での署名 (enbedded) もしくはメールでの署名案内送信 (remote) 
            </span>
            <div class="help-block with-errors"></div>
          </div>
          <div class="form-group">
            <label for="access_code">アクセスコード</label>
            <input type="text" class="form-control" id="access_code" name="inputAccessCode" placeholder="" value="{{Config('loanco.access_code')}}" />
            <span class="help-block">
              ドキュメントへ署名する前にお客様に入力していただくアクセスコードを設定 (任意)
            </span>
            <div class="help-block with-errors"></div>
          </div>
          <div class="form-group">
            <label for="authentication">追加認証</label>
            <select class="form-control" name="inputAuthentication" disabled>
                @foreach($authentication_options as $koption)
                <option value="{{ $koption }}" @if(old('inputAuthentication') == $koption) selected @endif>{{$koption}}</option>
                @endforeach
            </select>
            <span class="help-block">
              ドキュメントへ署名する前に電話による認証を有効化 (<a href="https://support.docusign.com/guides/ndse-user-guide-how-phone-authentication-works" target="_blank">詳細参照</a>)
              <br />
              * 本設定はDocuSign側設定で有効化可能 
            </span>
          </div>
        </div>


        <hr />

        <div class="row">
          <div class="col-sm-12 text-center">
            <button type="submit" class="btn btn-primary has-spinner">
              個人ローンの申し込み
              <span class="spinner"><i class="fa fa-spinner fa-spin icon-spin"></i></span>
            </button>
          </div>
        </div>


      </form>

    </div>

    <div class="col-sm-6">

      <h2 class="text-center" style="opacity:0;">
        個人ローン申し込み
      </h2>

      <hr />

      <p class="text-right2">
        <span class="collapseTrigger collapsed" data-toggle="collapse" data-target="#collapseHow" aria-expanded="false" aria-controls="collapseHow">
          <i class="fa fa-plus-square-o show-on-collapsed" aria-hidden="true"></i><i class="fa fa-minus-square-o show-on-open" aria-hidden="  true"></i> 本ケースの背景
        </span>
      </p>
      <div class="collapse" id="collapseHow">

        <hr />


        <h4>
          本サンプルの機能:
        </h4>
        <ul>
          <li>1名の署名者</li>
          <li>Word文書(.DOCX)のインポート</li>
          <li>フィールド項目自動配置(アンカー)</li>
          <li>埋め込み署名(受信者ビュー)</li>
          <li>アクセスコード認証</li>
        </ul>

        <br />


        <h4>
          コードの流れ: 
        </h4>

        <h5>
          ステップ 1
        </h5>

        <p>
          入力されたフォーム情報が送信された際に、<a href="https://docs.docusign.com/esign/restapi/Envelopes/Envelopes/create/" target="_blank">Envelopes: create</a> APIを使って、対応したフォーム内容を元に署名リクエストを生成します。作成されるエンベロープは、<code>document</code> 、<code>signer</code> の受信者タイプ、それからフォームに入力された情報を含む <code>tabs</code> で構成されます。埋め込み署名が選択されている場合、受信者として <code>clientUserId</code> の設定が必要です。
        </p> 
        
        <p>
          <code>accessCode</code> もしくは追加の認証(電話やIDチェック)を使って、複数要素認証をすることも可能です。また、本サンプルでは、文書上にフィールドを適切な場所に自動配置するため、<a href="https://www.docusign.com/developer-center/explore/features/stick-etabs#tab-positioning" target="_blank">Auto-Place</a> 機能を利用しています。
        </p>

        <p>
          テンプレートからエンベロープを作成し、送信するために、HTTPのPOSTリクエストを下記に送信します:

<pre>
POST /v2/accounts/{accountId}/envelopes
</pre>
        </p>
        
        <p style="padding:20px 0;">
          <span class="collapseTrigger collapsed" data-toggle="collapse" data-target="#collapseJSON" aria-expanded="false" aria-controls="collapseJSON">
            <i class="fa fa-plus-square-o show-on-collapsed" aria-hidden="true"></i><i class="fa fa-minus-square-o show-on-open" aria-hidden="  true"></i> サンプルリクエストのJSONを参照
          </span>
        </p>
        <div class="collapse" id="collapseJSON">
<pre>
{
  "status": "sent",
  "emailSubject": "Personal Loan Application",
  "emailBlurb": "Please sign the Loan application to start the application process.",
  "documents": [
    {
      "documentId": "1",
      "name": "Document",
      "fileExtension": "docx",
      "documentBase64": "-- Base64-encoding document bytes are here --"
    }
  ],
  "recipients": {
    "signers": [
      {
        "tabs": {
          "signHereTabs": [
            {
              "documentId": "1",
              "recipientId": "1",
              "pageNumber": "1",
              "anchorString": "X:",
              "anchorXOffset": "100",
              "anchorYOffset": "-2"
            }
          ],
          "fullNameTabs": [
            {
              "documentId": "1",
              "recipientId": "1",
              "pageNumber": "1",
              "anchorString": "Name:",
              "anchorXOffset": "100",
              "anchorYOffset": "-2"
            }
          ],
          "textTabs": [
            {
              "name": "Phone",
              "locked": "false",
              "tabLabel": "Phone",
              "documentId": "1",
              "recipientId": "1",
              "pageNumber": "1",
              "anchorString": "Phone:",
              "anchorXOffset": "100",
              "anchorYOffset": "-2"
            },
            {
              "name": "AddressLine1",
              "value": "123 Disneyland Ave",
              "locked": "false",
              "tabLabel": "AddressLine1",
              "documentId": "1",
              "recipientId": "1",
              "pageNumber": "1",
              "anchorString": "Address:",
              "anchorXOffset": "100",
              "anchorYOffset": "-2"
            },
            {
              "name": "AddressLine2",
              "locked": "false",
              "tabLabel": "AddressLine2",
              "documentId": "1",
              "recipientId": "1",
              "pageNumber": "1",
              "anchorString": "Address:",
              "anchorXOffset": "100",
              "anchorYOffset": "35"
            },
            {
              "name": "AddressCityStateZip",
              "value": "Anaheim, CA 90210",
              "locked": "false",
              "tabLabel": "AddressCityStateZip",
              "documentId": "1",
              "recipientId": "1",
              "pageNumber": "1",
              "anchorString": "Address:",
              "anchorXOffset": "100",
              "anchorYOffset": "70"
            }
          ],
          "numberTabs": [
            {
              "name": "Amount",
              "locked": "false",
              "tabLabel": "Amount",
              "documentId": "1",
              "recipientId": "1",
              "pageNumber": "1",
              "anchorString": "Amount:",
              "anchorXOffset": "100",
              "anchorYOffset": "-2"
            },
            {
              "name": "PaymentDuration",
              "locked": "false",
              "tabLabel": "PaymentDuration",
              "documentId": "1",
              "recipientId": "1",
              "pageNumber": "1",
              "anchorString": "Payment Duration:",
              "anchorXOffset": "200",
              "anchorYOffset": "-2"
            }
          ],
          "emailTabs": [
            {
              "name": "Email",
              "value": "-- RECIPIENT EMAIL HERE --",
              "tabLabel": "Email",
              "documentId": "1",
              "recipientId": "1",
              "pageNumber": "1",
              "anchorString": "E-mail:",
              "anchorXOffset": "100",
              "anchorYOffset": "-2"
            }
          ],
          "formulaTabs": [
            {
              "formula": "[Amount]/[PaymentDuration]",
              "name": "MonthlyPayment",
              "tabLabel": "MonthlyPayment",
              "documentId": "1",
              "recipientId": "1",
              "pageNumber": "1",
              "anchorString": "Monthly Payment:",
              "anchorXOffset": "200",
              "anchorYOffset": "-2"
            }
          ]
        },
        "name": "-- RECIPIENT NAME HERE --",
        "email": "-- RECIPIENT EMAIL HERE --",
        "recipientId": "1",
        "accessCode": "12345",  // if access code selected
        "clientUserId": "1001"  // if embedded signing selected
      }
    ]
  }
}
</pre>
        </div>

        <h5>
          ステップ 2
        </h5>

        <p>
          埋め込み署名が選択された場合、受信者用の署名URLを生成するため、<a href="https://docs.docusign.com/esign/restapi/Envelopes/EnvelopeViews/createRecipient/" target="_blank">EnvelopeViews: createRecipient</a> APIを次に利用します。正しく動作させるために、ステップ1でエンベロープが送信された際の受信者を <code>clientUserId</code> プロパティにセットする必要があります。
        </p>

        <p>
          エンベロープが送信された後、エンベロープIDと受信者情報がDocuSign側にセッション情報として保存されます。それから、<tt>/sign/embedded</tt> ページにリダイレクトされます。ここでは、セッション情報からエンベロープIDと受信者情報を取得し、生成されたURLからブラウザ内にフルサイズ(幅と高さ)のIFrameとして受信者用のビューが生成されます。
        </p>
        
        <p>
          エンベロープの受信者用ビューを生成するため、HTTPのPOSTリクエストを下記に送信します:
        
<pre>
POST /v2/accounts/{accountId}/envelopes/{envelopeId}/views/recipient
</pre>
        </p>
        <p style="padding:20px 0;">
          <span class="collapseTrigger collapsed" data-toggle="collapse" data-target="#collapseJSON2" aria-expanded="false" aria-controls="collapseJSON2">
            <i class="fa fa-plus-square-o show-on-collapsed" aria-hidden="true"></i><i class="fa fa-minus-square-o show-on-open" aria-hidden="  true"></i> サンプルリクエストのJSONを参照
          </span>
        </p>
        <div class="collapse" id="collapseJSON2">
<pre>
{
  "clientUserId": "1001",
  "userName": "-- RECIPIENT NAME HERE --",
  "email": "-- RECIPIENT EMAIL HERE --",
  "recipientId": "1",
  "returnUrl": "-- RETURN URL HERE --",
  "authenticationMethod": "email"
}
</pre>

        </div>

      </div>



    </div>

  </div>

  <hr>

</div>
@endsection