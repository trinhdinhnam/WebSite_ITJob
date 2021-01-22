$("#validateTypeFile").addClass('hide');
function CheckPdfFile() {
    var CvInput = document.getElementById('inputCV').files;
    if(CvInput.length > 0){
        var fileToLoad = CvInput[0];
        var fileReader = new FileReader();
        fileReader.onload = function (fileLoaderEvent) {
            var srcData = fileLoaderEvent.target.result;
            document.getElementById('CompanyLogo').src = srcData;
        }
        fileReader.readAsDataURL(fileToLoad);
    }
}

$("#saveApply").click(function() {
    var test_value = $("#inputCV").val();
    var extension = test_value.split('.').pop().toLowerCase();
    if ($.inArray(extension, ['pdf']) == -1) {
        $("#validateTypeFile").removeClass('hide');
        $("#validateTypeFile").addClass('show');
        $("#inputCV").addClass('active-border');
        //alert("Bạn phải nhập vào CV .pdf!");
        return false;
    }
});