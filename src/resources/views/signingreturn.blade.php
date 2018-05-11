@extends('layouts.master_loanco')
@section('title', 'LoanCoへようこそ')

@section('body')
<div class="container">

	<div class="row">
		<div class="col-md-6">

			<div class="">
				@if (isset($event) && $event === 'signing_complete')
					<h2 class="text-center">
						署名が完了しました!
					</h2>
					<p>
						{{$msg}}
					</p>
				@else
					<h2 class="">
						@if (isset($event))
							応答イベント: {{$event}}
						@else
							@if (app('request')->input('event'))
								応答イベント: {{ app('request')->input('event')}}
							@endif
						@endif
					</h2>
					<p>
					@if (isset($msg))
						{{$msg}}
					@else
						@if (app('request')->input('msg'))
							{{app('request')->input('msg')}}
						@endif
					@endif
					</p>

				@endif

				<div class="">
					<br />
					@if (isset($waitingForRemote))
						<div>
							<strong>
								お申込みを受付致しました。現在内容レビュー中です。完了致しましたらご連絡致します。
							</strong>
						</div>
					@else
						@if (isset($nextUrl))
							<div>
								<strong>
									<a href="{{$nextUrl}}">次の署名者へすすめるためにクリックして下さい</a>
								</strong>
							</div>
						@else
							<div>
								<a href="/">ホームに戻る</a>
							</div>
						@endif
                    @endif


					<div>
						<p>
							<br />
							<a href="/envelopes">エンベロープの確認</a>
						</p>
					</div>

					<br />
					<br />

				</div>

			</div>


			<!-- Call to Action Section -->
			<div class="well2 action-section text-center">
				<div class="row">
					<div class="col-md-10 col-md-offset-1">
						<h4>
						  DocuSign APIを今日からはじめましょう
						</h4>
						<br />
					</div>
				</div>
				<div class="row">
					<div class="col-md-7 col-md-offset-3">
						<a class="btn btn-lg btn-default btn-block" href="https://secure.docusign.com/signup/developer" target="_blank">
						  サンドボックス環境の取得
						</a>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<p>
						  <br />
						  サンドボックス環境を使って、APIを無料でお試しいただけます! サンドボックス環境は期間の制約無しに、大半の機能をご利用いただけます。
						</p>
					</div>
				</div>
			</div>

		</div>
		<div class="col-md-6">

			<br />

			<h4>
				署名時の応答イベント
			</h4>

			<div>

				<p>
					ブラウザ内の埋め込み署名画面から署名者がアプリ画面に戻ってきた際に、作成したカスタムアプリはクエリストリング情報として下記のイベントのうち1つを受け取ります: 
				</p>

				<div>
					<p>
						<strong>signing_complete</strong>
						<br />
						受信者の署名が完了しました! 署名されたドキュメントは、DocuSignのサーバーにセキュアに保存されます。
					</p>

					<p>
						<strong>cancel</strong>
						<br />
						受信者が、「署名の辞退」ではなく、「保存して後で対応する」を選択しました。
					</p>

					<p>
						<strong>decline</strong>
						<br />
						受信者が、「署名の辞退」を選択しました。本ドキュメントは無効となりました。
					</p>

					<p>
						<strong>exception</strong>
						<br />
						署名セッション中、サーバーでエラーが発生しました。Webサービスに渡されたパラメータをご確認下さい。
					</p>

					<p>
						<strong>fax_pending</strong>
						<br />
						保留中のFaxがあります。
					</p>

					<p>
						<strong>session_timeout</strong>
						<br />
						受信者が、設定時間内に署名を行いませんでした。デフォルトのタイムアウト時間は20分です。
					</p>

					<p>
						<strong>ttl_expired</strong>
						<br />
						トークンがタイムアウト期間内に利用されなかったか、すでに利用済みトークン情報であったためです。
					</p>

					<p>
						<strong>viewing_complete</strong>
						<br />
						受信者が、文書の参照を完了しました(署名不要の場合)。
					</p>

					<p>
						<a href="https://www.docusign.com/developer-center/explore/features/embedding-docusign" target="_blank">Learn more about Embedded Signing</a>
					</p>

				</div>


			</div>

		</div>
	</div>
</div>
@endsection