/**
 * Filter to render HTML code
 */
as.filter("sanitize", ["$sce", function($sce) {
    return function(htmlCode){
        return $sce.trustAsHtml(htmlCode);
    }
}]);

/**
 * Filter to calculate the number of items in an object
 */
as.filter('objLength', function() {
    return function(object) {
        var count = 0;

        for(var i in object){
            count++;
        }
        return count;
    }
});
