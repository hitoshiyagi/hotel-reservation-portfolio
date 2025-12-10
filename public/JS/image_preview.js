document.addEventListener("DOMContentLoaded", function () {
    const imageUrlInput = document.getElementById("image_url");
    const imagePreview = document.getElementById("image_preview");
    const noImageText = document.getElementById("no_image_text");

    if (!imageUrlInput) return; // 該当要素がないページでは処理を終了

    function updatePreview() {
        const url = imageUrlInput.value;

        if (url && url.startsWith("http")) {
            // 画像をロードしようと試みる
            imagePreview.src = url;
            imagePreview.onload = function () {
                imagePreview.style.display = "block";
                noImageText.style.display = "none";
                noImageText.textContent = "プレビュー画像"; // 成功時はテキストを元に戻す
            };
            imagePreview.onerror = function () {
                // 画像のロードに失敗した場合
                imagePreview.style.display = "none";
                noImageText.style.display = "block";
                noImageText.textContent = "画像URLが無効です。";
            };
        } else {
            // URLが空または無効な場合
            imagePreview.style.display = "none";
            imagePreview.src = "";
            noImageText.style.display = "block";
            noImageText.textContent =
                "URLを入力するとここに画像が表示されます。";
        }
    }

    imageUrlInput.addEventListener("input", updatePreview);

    // ページロード時の初期チェック
    updatePreview();
});