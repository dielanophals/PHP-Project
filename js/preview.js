function filePreview(input) {
    if (input.files && input.files[0]) {
        let reader = new FileReader();
        reader.onload = function (e) {
            $('#uploadForm + img').remove();
            $('#uploadForm').after('<img class="previewImg" src="'+e.target.result+'" width="450" height="auto"/>');
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$('#fileToUpload').change(function () {
    filePreview(this);
});

$('select').change(function() {
    // 1977
    if ($(this).val() == "1977") { $('.previewImg').addClass('1977'); } 
    else { $('.previewImg').removeClass('1977'); }
    // aden
    if ($(this).val() == "aden") { $('.previewImg').addClass('aden'); } 
    else { $('.previewImg').removeClass('aden'); }
    // brannan
    if ($(this).val() == "brannan") { $('.previewImg').addClass('brannan'); } 
    else { $('.previewImg').removeClass('brannan'); }
    // brooklyn
    if ($(this).val() == "brooklyn") { $('.previewImg').addClass('brooklyn'); } 
    else { $('.previewImg').removeClass('brooklyn'); }
    // clarendon
    if ($(this).val() == "clarendon") { $('.previewImg').addClass('clarendon'); } 
    else { $('.previewImg').removeClass('clarendon'); }
    // earlybird
    if ($(this).val() == "earlybird") { $('.previewImg').addClass('earlybird'); } 
    else { $('.previewImg').removeClass('earlybird'); }
    // gingham
    if ($(this).val() == "gingham") { $('.previewImg').addClass('gingham'); } 
    else { $('.previewImg').removeClass('gingham'); }
    // hudson
    if ($(this).val() == "hudson") { $('.previewImg').addClass('hudson'); } 
    else { $('.previewImg').removeClass('hudson'); }
    // inkwell
    if ($(this).val() == "inkwell") { $('.previewImg').addClass('inkwell'); } 
    else { $('.previewImg').removeClass('inkwell'); }
    // kelvin
    if ($(this).val() == "kelvin") { $('.previewImg').addClass('kelvin'); } 
    else { $('.previewImg').removeClass('kelvin'); }
    // lark
    if ($(this).val() == "lark") { $('.previewImg').addClass('lark'); } 
    else { $('.previewImg').removeClass('lark'); }
    // lofi
    if ($(this).val() == "lofi") { $('.previewImg').addClass('lofi'); } 
    else { $('.previewImg').removeClass('lofi'); }
    // maven
    if ($(this).val() == "maven") { $('.previewImg').addClass('maven'); } 
    else { $('.previewImg').removeClass('maven'); }
    // mayfair
    if ($(this).val() == "mayfair") { $('.previewImg').addClass('mayfair'); } 
    else { $('.previewImg').removeClass('mayfair'); }
    // moon
    if ($(this).val() == "moon") { $('.previewImg').addClass('moon'); } 
    else { $('.previewImg').removeClass('moon'); }
    // nashville
    if ($(this).val() == "nashville") { $('.previewImg').addClass('nashville'); } 
    else { $('.previewImg').removeClass('nashville'); }
    // perpetua
    if ($(this).val() == "perpetua") { $('.previewImg').addClass('perpetua'); } 
    else { $('.previewImg').removeClass('perpetua'); }
    // reyes
    if ($(this).val() == "reyes") { $('.previewImg').addClass('reyes'); } 
    else { $('.previewImg').removeClass('reyes'); }
    // rise
    if ($(this).val() == "rise") { $('.previewImg').addClass('rise'); } 
    else { $('.previewImg').removeClass('rise'); }
    // slumber
    if ($(this).val() == "slumber") { $('.previewImg').addClass('slumber'); } 
    else { $('.previewImg').removeClass('slumber'); }
    // stinson
    if ($(this).val() == "stinson") { $('.previewImg').addClass('stinson'); } 
    else { $('.previewImg').removeClass('stinson'); }
    // toaster
    if ($(this).val() == "toaster") { $('.previewImg').addClass('toaster'); } 
    else { $('.previewImg').removeClass('toaster'); }
    // valencia
    if ($(this).val() == "valencia") { $('.previewImg').addClass('valencia'); } 
    else { $('.previewImg').removeClass('valencia'); }
    // walden
    if ($(this).val() == "walden") { $('.previewImg').addClass('walden'); } 
    else { $('.previewImg').removeClass('walden'); }
    // willow
    if ($(this).val() == "willow") { $('.previewImg').addClass('willow'); } 
    else { $('.previewImg').removeClass('willow'); }
    // xpro2
    if ($(this).val() == "xpro2") { $('.previewImg').addClass('xpro2'); } 
    else { $('.previewImg').removeClass('xpro2'); }
});