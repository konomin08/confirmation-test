<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact Form</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
</head>

<body>
  <header class="header">
    <div class="header__inner">
      <a class="header__logo" href="/">
        Contact Form
      </a>
    </div>
  </header>

  <main>
    <div class="contact-form__content">
      <div class="contact-form__heading">
        <h2>お問い合わせ</h2>
      </div>
      <form class="form" action="/contacts/confirm" method="post">
        @csrf

        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item">お名前</span>
            <span class="form__label--required">必須</span>
          </div>
          <div class="form__group-content">
            <div class="form__name-wrapper">
              <div class="form__input--text">
                <input type="text" name="last_name" placeholder="例：山田" value="{{ old('last_name', $contact['last_name'] ?? '') }}" />
              </div>
              <div class="form__error">
                @error('last_name')
                {{ $message }}
                @enderror
              </div>
              <div class="form__input--text">
                <input type="text" name="first_name" placeholder="例：太郎" value="{{ old('first_name', $contact['first_name'] ?? '') }}" />
              </div>
              <div class="form__error">
                @error('first_name')
                {{ $message }}
                @enderror
              </div>
            </div>
          </div>
        </div>

        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item">性別</span>
            <span class="form__label--required">必須</span>
          </div>
          <div class="form__group-content">
            <div class="form__gender">
              <label class="form__radio">
                <input type="radio" name="gender" value="男性" {{ old('gender', $contact['gender'] ?? '男性') == '男性' ? 'checked' : '' }}>
                男性
              </label>

              <label class="form__radio">
                <input type="radio" name="gender" value="女性"{{ old('gender', $contact['gender'] ?? '男性') == '女性' ? 'checked' : '' }}>
                女性
              </label>

              <label class="form__radio">
                <input type="radio" name="gender" value="その他"{{ old('gender', $contact['gender'] ?? '男性') == 'その他' ? 'checked' : '' }}>
                その他
              </label>
            </div>
            <div class="form__error">
              @error('gender')
              {{ $message }}
              @enderror
            </div>
          </div>
        </div>

        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item">メールアドレス</span>
            <span class="form__label--required">必須</span>
          </div>
          <div class="form__group-content">
            <div class="form__input--text">
              <input type="email" name="email" placeholder="例：test@example.com" value="{{ old('email', $contact['email'] ?? '') }}" />
            </div>
            <div class="form__error">
              @error('email')
              {{ $message }}
              @enderror

            </div>
          </div>
        </div>

        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item">電話番号</span>
            <span class="form__label--required">必須</span>
          </div>
          <div class="form__group-content">
            <div class="form__input--text">
              <input type="tel" name="tel" placeholder="例：09012345678" value="{{ old('tel', $contact['tel'] ?? '') }}" />
            </div>
            <div class="form__error">
              @error('tel')
              {{ $message }}
              @enderror
            </div>
          </div>
        </div>

        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item">住所</span>
            <span class="form__label--required">必須</span>
          </div>
          <div class="form__group-content">
            <div class="form__input--text">
              <input type="text" name="address" placeholder="例：東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address', $contact['address'] ?? '') }}" />
            </div>
            <div class="form__error">
              @error('address')
              {{ $message }}
              @enderror
            </div>
          </div>
        </div>

        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item">建物名</span>
          </div>
          <div class="form__group-content">
            <div class="form__input--text">
              <input type="text" name="building" placeholder="例：千駄ヶ谷マンション101" value="{{ old('building', $contact['building'] ?? '') }}" />
            </div>
          </div>
        </div>

        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item">お問い合わせの種類</span>
            <span class="form__label--required">必須</span>
          </div>
          <div class="form__group-content">
            <div class="search-form__item">
              <select class="search-form__item-select" name="category">
                <option value="" {{ old('category', $contact['category'] ?? '') == '' ? 'selected' : '' }}>選択してください</option>
                <option value="商品のお届けについて" {{ old('category', $contact['category'] ?? '') == '商品のお届けについて' ? 'selected' : '' }}>商品のお届けについて</option>
                <option value="商品の交換について" {{ old('category', $contact['category'] ?? '') == '商品の交換について' ? 'selected' : '' }}>商品の交換について</option>
                <option value="商品トラブル" {{ old('category', $contact['category'] ?? '') == '商品トラブル' ? 'selected' : '' }}>商品トラブル</option>
                <option value="ショップへのお問い合わせ" {{ old('category', $contact['category'] ?? '') == 'ショップへのお問い合わせ' ? 'selected' : '' }}>ショップへのお問い合わせ</option>
                <option value="その他" {{ old('category', $contact['category'] ?? '') == 'その他' ? 'selected' : '' }}>その他</option>
              </select>
            </div>
            <div class="form__error">
              @error('category')
              {{ $message }}
              @enderror
            </div>
          </div>
        </div>

        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item">お問い合わせ内容</span>
            <span class="form__label--required">必須</span>
          </div>
          <div class="form__group-content">
            <div class="form__input--textarea">
              <textarea name="content" placeholder="資料をいただきたいです">{{ old('content', $contact['content'] ?? '') }}</textarea>
            </div>
          </div>
          <div class="form__error">
              @error('content')
              {{ $message }}
              @enderror
          </div>
        </div>
        <div class="form__button">
          <button class="form__button-submit" type="submit">送信</button>
        </div>
      </form>
    </div>
  </main>
</body>

</html>
