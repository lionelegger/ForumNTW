/**
 * Filter to render HTML code
 */
as.filter("sanitize", ["$sce", function($sce) {
    return function(htmlCode){
        return $sce.trustAsHtml(htmlCode);
    }
}]);

