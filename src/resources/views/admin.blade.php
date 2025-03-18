<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>管理画面</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
</head>

<body>
  <header class="header">
    <div class="header__inner">
      <a class="header__logo" href="/">
        お問い合わせ管理
      </a>
      <nav class="header__nav">
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ログアウト</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
      </nav>
    </div>
  </header>

  <main>
    <div class="admin__content">
      <div class="admin__heading">
        <h2>お問い合わせ一覧</h2>
      </div>

      <form method="GET" action="{{ route('admin') }}">
        <input type="text" name="search" placeholder="名前やメールアドレスを入力してください" value="{{ request('search') }}">
        <select name="gender">
          <option value="">性別を選択</option>
          <option value="男性" {{ request('gender') === '男性' ? 'selected' : '' }}>男性</option>
          <option value="女性" {{ request('gender') === '女性' ? 'selected' : '' }}>女性</option>
        </select>
        <select name="category">
          <option value="">お問い合わせの種類</option>
          <option value="商品のお届けについて" {{ request('category') === '商品のお届けについて' ? 'selected' : '' }}>商品のお届けについて</option>
          <option value="商品の交換について" {{ request('category') === '商品の交換について' ? 'selected' : '' }}>商品の交換について</option>
          <option value="商品トラブル" {{ request('category') === '商品トラブル' ? 'selected' : '' }}>商品トラブル</option>
          <option value="ショップへのお問い合わせ" {{ request('category') === 'ショップへのお問い合わせ' ? 'selected' : '' }}>ショップへのお問い合わせ</option>
          <option value="その他" {{ request('category') === 'その他' ? 'selected' : '' }}>その他</option>
        </select>
        <input type="date" name="date" value="{{ request('date') }}">
        <button type="submit">検索</button>
        <button type="button" onclick="resetForm()">リセット</button>
      </form>

      <script>
        function resetForm() {
          window.location.href = "{{ route('admin') }}";
        }
      </script>

      <table class="admin__table">
        <thead>
          <tr>
            <th>お名前</th>
            <th>性別</th>
            <th>メールアドレス</th>
            <th>お問い合わせの種類</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $contact)
              <tr>
                <td>{{ $contact->name }}</td>
                <td>{{ $contact->gender ?? '未入力' }}</td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->category ?? '未入力' }}</td>
                <td>
                  <a href="{{ route('contact.show', $contact->id) }}" class="btn btn-details">詳細</a>
                </td>
              </tr>
            @endforeach
        </tbody>
      </table>

      <div class="pagination">
        {{ $contacts->links() }}
      </div>

      @foreach ($contacts as $contact)
      <dialog id="modal-{{ $contact->id }}" class="modal">
        <div class="modal-content">
          <form method="dialog">
            <button class="close-btn">×</button>
          </form>

          <h3>お問い合わせ詳細</h3>
          <p>名前: {{ $contact->name }}</p>
          <p>性別: {{ $contact->gender ?? '未入力' }}</p>
          <p>メール: {{ $contact->email }}</p>
          <p>お問い合わせの種類: {{ $contact->category ?? '未入力' }}</p>
          <p>内容: {{ $contact->content }}</p>
          <p>送信日: {{ $contact->created_at->format('Y-m-d H:i') }}</p>

          <form method="POST" action="{{ route('contact.destroy', $contact->id) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-delete">削除</button>
          </form>
        </div>
      </dialog>
      @endforeach

    </div>
  </main>
</body>

</html>
