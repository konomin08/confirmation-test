<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>詳細表示</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
</head>

<body>
  <main>
    <div class="admin__content">
      <h2>お問い合わせ詳細</h2>
      
      <div id="modal" class="modal" style="display:block;">
        <div class="modal-content">
          <span class="close-btn" onclick="document.getElementById('modal').style.display='none'">&times;</span>
          <h3>お問い合わせ詳細</h3>
          <p>名前: {{ $contact->name }}</p>
          <p>性別: {{ $contact->gender ?? '未入力' }}</p>
          <p>メール: {{ $contact->email }}</p>
          <p>お問い合わせの種類: {{ $contact->category ?? '未入力' }}</p>
          <p>内容: {{ $contact->content }}</p>
          <p>送信日: {{ $contact->created_at->format('Y-m-d H:i') }}</p>
          
          <form method="POST" action="{{ route('contact.destroy', $contact->id) }}" id="delete-form">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-delete">削除</button>
          </form>
        </div>
      </div>
    </div>
  </main>
</body>

</html>
