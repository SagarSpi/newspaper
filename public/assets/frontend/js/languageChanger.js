function loadGoogleTranslate() {
    new google.translate.TranslateElement(
        {
            pageLanguage: "en",
            includedLanguages:
                "bn,en,hi,ur,gu,ja,zh-TW,ko,sa,ru,bho,br,fr,pt,ne,tr,ta,de,id,it,af",
            layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
            autoDisplay: false,
        },
        "translator"
    );
}
