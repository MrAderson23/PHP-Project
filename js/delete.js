window.onload = function() {
    var fileEle = document.getElementById('file1');
    var previewEle = document.getElementById('preview');
    fileEle.addEventListener('change', function(e) {
        // Get the selected file
        var pic = e.target.files[0];

        // Create a new URL that references to the file
        var url = URL.createObjectURL(pic);

        // Set the source for preview element
        previewEle.src = url;
    });

    function handleDragStart(e) {
        this.style.cssText = "opacity:0.4; cursor:move"
        e.dataTransfer.setData('Text', this.id)
        document.getElementById('navdelete').style.display = 'flex';
        document.getElementById('nav').style.display = 'none';
    }

    function handleDragEnd(e) {
        this.style.cssText = "opacity:1; cursor:auto"
        document.getElementById('nav').style.display = 'flex';
        document.getElementById('navdelete').style.display = 'none';
    }

    let items = document.querySelectorAll('.masonry .item');
    items.forEach(function(item) {
        item.addEventListener('dragstart', handleDragStart);
        item.addEventListener('dragend', handleDragEnd);
    });
    document.getElementById('navdelete').addEventListener('dragover', function(e) {
        document.getElementById('nav').style.display = 'none';
        e.preventDefault()
    });
    document.getElementById('navdelete').addEventListener('drop', function(e) {
        if (confirmDelete(e.dataTransfer.getData('Text'))) {
            var ajax = new XMLHttpRequest();
            ajax.open("GET", "delete_member.php?id=" + e.dataTransfer.getData('Text'));
            ajax.send();
            $("#" + e.dataTransfer.getData('Text') + "").remove();
        }
        e.preventDefault();
    });

    function confirmDelete(a) {
        return confirm('Are you sure you would like to delete ' + a + ' ?');
    }
}