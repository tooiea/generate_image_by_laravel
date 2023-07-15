<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>画像作成フォーム</title>
</head>
<body>
    <div class="container">
        <h1 class="mt-4 mb-4">画像作成フォーム</h1>
        <form action="{{ route('generate.image.download') }}" method="post">
            @csrf
            <div class="row mb-3">
                <label for="sizeX" class="col-sm-3 col-form-label">画像の幅 (x)</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" id="sizeX" name="sizeX" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="sizeY" class="col-sm-3 col-form-label">画像の高さ (y)</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" id="sizeY" name="sizeY" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="filesize" class="col-sm-3 col-form-label">画像のサイズ (Mバイト)</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" id="filesize" name="filesize" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="extension" class="col-sm-3 col-form-label">画像の拡張子</label>
                <div class="col-sm-9">
                    <select class="form-select" id="extension" name="extension" required>
                        <option value="">拡張子を選択してください</option>
                        @foreach (\App\Enums\EnumImage::asSelectArray() as $value => $text)
                        <option value="{{ $value }}">{{ $text }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-9 offset-sm-3">
                    <button type="submit" class="btn btn-primary">画像作成</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
