
@extends('layouts.master_loanco')
@section('title', 'LoanCoへようこそ')

@section('body')
<section class="home-hero">
  <div style="background:rgba(0,0,0,0.4); padding:40px 0">
    <div class="container">
      <div style="color:white;">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-header main-page-header text-center">
                    LoanCoへようこそ
                </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h4 class="text-center">
                    お客様の財務ニーズにお答えいたします 
                </h4>
                <br />
                <br />
                <br />
            </div>
        </div>
      </div>
      <div class="row">
          <div class="col-md-4">
              <div class="panel panel-default">
                  <div class="panel-heading">
                      <h3 class="text-center"><i class="fa fa-fw fa-credit-card"></i>
                        個人ローン
                      </h3>
                  </div>
                  <div class="panel-body">
                      <p class="loan-percentage">
                        2.75% - 3.15%
                      </p>
                      <div class="text-center">
                        <a href="/loan/personal" class="btn btn-default">お申込み</a>
                      </div>

                      <div class="loan-features">
                        <div class="collapseTrigger collapsed_OLD" data-toggle="collapse" data-target="#collapseLoan1" aria-expanded="false" aria-controls="collapseLoan1">
                          <!--<i class="fa fa-plus-square-o show-on-collapsed" aria-hidden="true"></i><i class="fa fa-minus-square-o show-on-open" aria-hidden="  true"></i> -->DocuSignの機能:
                        </div>
                        <div class="collapse in" id="collapseLoan1">
                          <ul>
                            <li>
                              <span data-toggle="tooltip" data-placement="top" title="本ドキュメントでは署名者は1名のみ">
                                1名の署名者
                              </span>
                            </li>
                            <li>
                              <span data-toggle="tooltip" data-placement="top" title="Word文書をインポート">
                                Word文書(.DOCX)のインポート
                              </span>
                            </li>
                            <li>
                              <span data-toggle="tooltip" data-placement="top" title="フィールドは署名者が入力したデータのそばに自動配置">
                                項目自動配置(アンカー)
                              </span>
                            </li>
                            <li>
                              <span data-toggle="tooltip" data-placement="top" title="現在のWebサイトから移動せずに署名可能">
                                埋め込み署名
                              </span>
                            </li>
                            <li>
                              <span data-toggle="tooltip" data-placement="top" title="複数の受信者認証方法を追加">
                                アクセスコード認証
                              </span>
                            </li>    
                            <br />                          
                          </ul>
                        </div>
                      </div>

                  </div>
              </div>
          </div>
          <div class="col-md-4">
              <div class="panel panel-default">
                  <div class="panel-heading">
                      <h3 class="text-center"><i class="fa fa-fw fa-car"></i>
                        自動車ローン
                      </h3>
                  </div>
                  <div class="panel-body">
                      <p class="loan-percentage">
                        〜 2.65%
                      </p>
                      <div class="text-center">
                        <a href="/loan/auto" class="btn btn-default">お申込み</a>
                      </div>

                      <div class="loan-features">
                        <div class="collapseTrigger collapsed_OLD" data-toggle="collapse" data-target="#collapseLoan2" aria-expanded="false" aria-controls="collapseLoan2">
                          <!--<i class="fa fa-plus-square-o show-on-collapsed" aria-hidden="true"></i><i class="fa fa-minus-square-o show-on-open" aria-hidden="  true"></i> -->DocuSignの機能:
                        </div>
                        <div class="collapse in" id="collapseLoan2">
                          <ul>
                            <li>
                              <span data-toggle="tooltip" data-placement="top" title="テンプレートを使って、承認プロセスを効率的に作成">
                                テンプレートからの送信
                              </span>
                            </li>                            
                            <li>
                              <span data-toggle="tooltip" data-placement="top" title="複数の署名者を使って、プロセスの順序を制御">
                                複数の署名者
                              </span>
                            </li>
                            <li>
                              <span data-toggle="tooltip" data-placement="top" title="1つのエンベロープに複数の文書を追加">
                                複数ドキュメント
                              </span>
                            </li>
                            <li>
                              <span data-toggle="tooltip" data-placement="top" title="数値と日付の自動計算">
                                自動計算項目
                              </span>
                            </li>
                            <li>
                              <span data-toggle="tooltip" data-placement="top" title="印影の自動生成もしくは印影画像登録による押印">
                                はんこによる押印
                              </span>
                            </li>
                            <br />
                            <br />
                          </ul>
                        </div>
                      </div>

                  </div>
              </div>
          </div>
          
          <div class="col-md-4">
              <div class="panel panel-default">
                  <div class="panel-heading">
                      <h3 class="text-center"><i class="fa fa-fw fa-ship"></i>
                        ヨットローン
                      </h3>
                  </div>
                  <div class="panel-body">
                      <p class="loan-percentage">
                        High-seas Fun!
                      </p>
                      <div class="text-center">
                        <a href="/loan/sailboat" class="btn btn-default">お申込み</a>
                      </div>

                      <div class="loan-features">
                        <div class="collapseTrigger collapsed_OLD" data-toggle="collapse" data-target="#collapseLoan3" aria-expanded="false" aria-controls="collapseLoan3">
                          <!--<i class="fa fa-plus-square-o show-on-collapsed" aria-hidden="true"></i><i class="fa fa-minus-square-o show-on-open" aria-hidden="  true"></i> -->DocuSignの機能:
                        </div>
                        <div class="collapse in" id="collapseLoan3">
                          <ul>
                            <li>
                              <span data-toggle="tooltip" data-placement="top" title="ドキュメントに署名欄とイニシャル欄を追加">
                                署名/イニシャル
                              </span>
                            </li>
                            <li>
                              <span data-toggle="tooltip" data-placement="top" title="署名時や送信時、メールでのカスタムブランディング">
                                カスタムブランディング
                              </span>
                            </li>
                            <li>
                              <span data-toggle="tooltip" data-placement="top" title="受信者が任意のドキュメントを添付可能">
                                受信者による追加ファイル添付
                              </span>
                            </li>
                            <li>
                              <span data-toggle="tooltip" data-placement="top" title="DocuSignは順列・並列どちらの署名プロセスもサポート">
                                署名/承認ワークフロー
                              </span>
                            </li>
                            <li>
                              <span data-toggle="tooltip" data-placement="top" title="DocuSignは複数の画像を含む文書形式をサポート">
                                PNG画像の添付
                              </span>
                            </li>
                            <li>
                              <span data-toggle="tooltip" data-placement="top" title="エンベロープ内の各ドキュメントについて、誰が参照できるかを管理">
                                複雑なドキュメント参照権限管理
                              </span>
                            </li>
                          </ul>
                        </div>
                      </div>

                  </div>
              </div>
          </div>
      </div>
    </div>
  </div>
</section>

<!-- Call to Action Section -->
<section class="action-section">
  <div class="container">
    <div class="well2 text-center">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <h3>
                  DocuSign: 同意完了までの最もシンプルな方法
                </h3>
                <br />
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 col-md-offset-3">
                <a class="btn btn-lg btn-default btn-block" href="https://secure.docusign.com/signup/developer" target="_blank">
                  開発者Sandboxの作成
                </a>
            </div>
            <div class="col-md-3">
                <a class="btn btn-lg btn-default btn-block" href="https://www.docusign.com/developer-center" target="_blank">
                  もっと詳しく
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <p>
                  <br />
                  電子署名と承認のための、最も信頼性が高く、世界的に信頼されているサービス。 世界中で2億人以上のユーザー
                </p>
            </div>
        </div>
    </div>
  </div>
</section>
@endsection


