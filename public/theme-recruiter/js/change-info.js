    function ImageFileAsURL() {
        var fileSelected = document.getElementById('AvatarUpload').files;

        if(fileSelected.length > 0){
            var fileToLoad = fileSelected[0];
            var fileReader = new FileReader();
            fileReader.onload = function (fileLoaderEvent) {
                var srcData = fileLoaderEvent.target.result;
                document.getElementById('RecruiterAvatar').src = srcData;
            }
            fileReader.readAsDataURL(fileToLoad);
        }
    }
function CompanylogoFileAsURL() {
    var fileCompanyLogo = document.getElementById('CompanyLogoUpload').files;
    if(fileCompanyLogo.length > 0){
        var fileToLoad2 = fileCompanyLogo[0];
        var fileReader2 = new FileReader();
        fileReader2.onload = function (fileLoaderEvent) {
            var srcData = fileLoaderEvent.target.result;
            document.getElementById('CompanyLogo').src = srcData;
        }
        fileReader2.readAsDataURL(fileToLoad2);
    }
}
