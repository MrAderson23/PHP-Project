function _(el) {
    return document.getElementById(el);
}

// Handle the `paste` event
document.addEventListener('paste', function(evt) {
    var firstname = document.getElementById("firstname").value;
    var lastname = document.getElementById("lastname").value;
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    if (password == '' || firstname == '' || lastname == '' || email == '') {
        _("status").innerHTML = "Paste your image after you completed the form!";
    } else {
        // Get the data of clipboard
        var clipboardItems = evt.clipboardData.items;
        var items = [].slice.call(clipboardItems).filter(function(item) {
            // Filter the image items only
            return item.type.indexOf('image') !== -1;
        });
        if (items.length === 0) {
            return;
        }

        var item = items[0];
        // Get the blob of image
        var file1 = item.getAsFile();
        var imageEle = document.getElementById('preview');
        imageEle.src = URL.createObjectURL(file1);
        uploadFile(file1);
    }
});

function uploadFile(a) {
    if (a != null) {
        var file = a;
    } else {
        var file = _("file1").files[0];
    }
    var action = document.getElementById("submit").value;
    var firstname = document.getElementById("firstname").value;
    var lastname = document.getElementById("lastname").value;
    var email = document.getElementById("email").value;
    var address = document.getElementById("address").value;
    var city = document.getElementById("city").value;
    var country = document.getElementById("country").value;
    var phone = document.getElementById("phone").value;
    var password = document.getElementById("password").value;


    // alert(file.name+" | "+file.size+" | "+file.type);
    var formdata = new FormData();
    if (file != null) {
        var c = Date.now() + file.name;
        formdata.append("file1", file, c);
    }
    formdata.append("action", action);
    formdata.append("firstname", firstname);
    formdata.append("lastname", lastname);
    formdata.append("email", email);
    formdata.append("address", address);
    formdata.append("city", city);
    formdata.append("country", country);
    formdata.append("phone", phone);
    formdata.append("password", password);
    if (password == '' || firstname == '' || lastname == '' || email == '' || document.getElementById('submit').value == 'added') {
        _("status").innerHTML = "Required field missing";
    } else {
        document.getElementById('submit').value = 'added';
        var ajax = new XMLHttpRequest();
        ajax.upload.addEventListener("progress", progressHandler, false);
        ajax.addEventListener("load", completeHandler, false);
        ajax.addEventListener("error", errorHandler, false);
        ajax.addEventListener("abort", abortHandler, false);
        ajax.open("POST", "add.php");
        ajax.send(formdata);

        var a = document.querySelectorAll('[id="id"]').length - 1;
        var b = document.querySelectorAll('[id="id"]')[a++].value;
        b++;
        $(".masonry").append("<div draggable='true' id='" + b + "' class='item template-upload'><div id='edtdata" + b + "'><a align='center'><img id='preview' class='pic' src='" + document.getElementById('preview').src + "'></a><br><a>ID:" + b + "<br></a><a>FIRST NAME: " + document.getElementById('firstname').value + "<br></a><a>LAST NAME: " + document.getElementById('lastname').value + "<br></a><a>EMAIL: " + document.getElementById('email').value + "<br></a><a>ADDRESS: " + document.getElementById('address').value + "<br></a><a>CITY: " + document.getElementById('city').value + "<br></a><a>COUNTRY: " + document.getElementById('country').value + "<br></a><a>PHONE: " + document.getElementById('phone').value + "<br></a></div><a style='cursor: pointer;' id='test' onclick='toggle" + b + "(); togg" + b + "()'>   <svg fill='#fff' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' version='1.1' id='Capa_1' width='32px' height='32px' viewBox='0 0 494.936 494.936' xml:space='preserve'><g><g><path fill='#fff' d='M389.844,182.85c-6.743,0-12.21,5.467-12.21,12.21v222.968c0,23.562-19.174,42.735-42.736,42.735H67.157    c-23.562,0-42.736-19.174-42.736-42.735V150.285c0-23.562,19.174-42.735,42.736-42.735h267.741c6.743,0,12.21-5.467,12.21-12.21    s-5.467-12.21-12.21-12.21H67.157C30.126,83.13,0,113.255,0,150.285v267.743c0,37.029,30.126,67.155,67.157,67.155h267.741    c37.03,0,67.156-30.126,67.156-67.155V195.061C402.054,188.318,396.587,182.85,389.844,182.85z'></path><path d='M483.876,20.791c-14.72-14.72-38.669-14.714-53.377,0L221.352,229.944c-0.28,0.28-3.434,3.559-4.251,5.396l-28.963,65.069    c-2.057,4.619-1.056,10.027,2.521,13.6c2.337,2.336,5.461,3.576,8.639,3.576c1.675,0,3.362-0.346,4.96-1.057l65.07-28.963    c1.83-0.815,5.114-3.97,5.396-4.25L483.876,74.169c7.131-7.131,11.06-16.61,11.06-26.692    C494.936,37.396,491.007,27.915,483.876,20.791z M466.61,56.897L257.457,266.05c-0.035,0.036-0.055,0.078-0.089,0.107    l-33.989,15.131L238.51,247.3c0.03-0.036,0.071-0.055,0.107-0.09L447.765,38.058c5.038-5.039,13.819-5.033,18.846,0.005    c2.518,2.51,3.905,5.855,3.905,9.414C470.516,51.036,469.127,54.38,466.61,56.897z'></path></g></g></svg></a><a id='test' href='delete_member.php?id=" + b + "' onclick='return confirm()'> <svg fill='#fff' version='1.1' id='Capa_1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' width='32' height='32' x='0px' y='0px' viewBox='0 0 729.837 729.838' style='enable-background:new 0 0 729.837 729.838;' xml:space='preserve'> <g> <g> <g> <path d='M589.193,222.04c0-6.296,5.106-11.404,11.402-11.404S612,215.767,612,222.04v437.476c0,19.314-7.936,36.896-20.67,49.653 c-12.733,12.734-30.339,20.669-49.653,20.669H188.162c-19.315,0-36.943-7.935-49.654-20.669 c-12.734-12.734-20.669-30.313-20.669-49.653V222.04c0-6.296,5.108-11.404,11.403-11.404c6.296,0,11.404,5.131,11.404,11.404 v437.476c0,13.02,5.37,24.922,13.97,33.521c8.6,8.601,20.503,13.993,33.522,13.993h353.517c13.019,0,24.896-5.394,33.498-13.993 c8.624-8.624,13.992-20.503,13.992-33.498V222.04H589.193z'></path> <path d='M279.866,630.056c0,6.296-5.108,11.403-11.404,11.403s-11.404-5.107-11.404-11.403v-405.07 c0-6.296,5.108-11.404,11.404-11.404s11.404,5.108,11.404,11.404V630.056z'></path> <path d='M376.323,630.056c0,6.296-5.107,11.403-11.403,11.403s-11.404-5.107-11.404-11.403v-405.07 c0-6.296,5.108-11.404,11.404-11.404s11.403,5.108,11.403,11.404V630.056z'></path> <path d='M472.803,630.056c0,6.296-5.106,11.403-11.402,11.403c-6.297,0-11.404-5.107-11.404-11.403v-405.07 c0-6.296,5.107-11.404,11.404-11.404c6.296,0,11.402,5.108,11.402,11.404V630.056L472.803,630.056z'></path> <path d='M273.214,70.323c0,6.296-5.108,11.404-11.404,11.404c-6.295,0-11.403-5.108-11.403-11.404 c0-19.363,7.911-36.943,20.646-49.677C283.787,7.911,301.368,0,320.73,0h88.379c19.339,0,36.92,7.935,49.652,20.669 c12.734,12.734,20.67,30.362,20.67,49.654c0,6.296-5.107,11.404-11.403,11.404s-11.403-5.108-11.403-11.404 c0-13.019-5.369-24.922-13.97-33.522c-8.602-8.601-20.503-13.994-33.522-13.994h-88.378c-13.043,0-24.922,5.369-33.546,13.97 C278.583,45.401,273.214,57.28,273.214,70.323z'></path> <path d='M99.782,103.108h530.273c11.189,0,21.405,4.585,28.818,11.998l0.047,0.048c7.413,7.412,11.998,17.628,11.998,28.818 v29.46c0,6.295-5.108,11.403-11.404,11.403h-0.309H70.323c-6.296,0-11.404-5.108-11.404-11.403v-0.285v-29.175 c0-11.166,4.585-21.406,11.998-28.818l0.048-0.048C78.377,107.694,88.616,103.108,99.782,103.108L99.782,103.108z M630.056,125.916H99.782c-4.965,0-9.503,2.02-12.734,5.274L87,131.238c-3.255,3.23-5.274,7.745-5.274,12.734v18.056h566.361 v-18.056c0-4.965-2.02-9.503-5.273-12.734l-0.049-0.048C639.536,127.936,635.021,125.916,630.056,125.916z'></path> </g> </g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg> </a> <form action='' method='post' enctype='multipart/form-data' id='edt" + b + "' hidden='hidden'> <input placeholder='ID' type='text' name='id' id='id' readonly value='" + b + "'> <input placeholder='First name' type='text' name='firstname' id='firstname' value='" + document.getElementById('firstname').value + "'> <input placeholder='Last name' type='text' name='lastname' id='lastname' value='" + document.getElementById('lastname').value + "'> <input placeholder='Email' type='text' name='email' id='email' value='" + document.getElementById('email').value + "'> <input placeholder='Address' type='text' name='address' id='address' value='" + document.getElementById('address').value + "'> <input placeholder='City' type='text' name='city' id='city' value='" + document.getElementById('city').value + "'> <input placeholder='Country' type='text' name='country' id='country' value='" + document.getElementById('country').value + "'> <input placeholder='Phone' type='text' name='phone' id='phone' value='" + document.getElementById('phone').value + "'> <input placeholder='New password' type='password' name='password' id='password' value=''> <br></br> <input style='display: none;' value='./img/pics/" + c + "' name='pic'> </input> <img id='preview' src='" + document.getElementById('preview').src + "' name='pic' class='pic'> </img> <br> <a>Change profile picture</a> <input type='file' name='the_file' id='the_file'> <label for='agree'>Remove profile picture</label> <input type='checkbox' name='agree[]' id='agree' value=''> <input style=' margin-top: 10px;'type='submit' name='update' id='submit' value='Update'> </form> <script> let toggle" + b + " = () => { let element = document.getElementById('edt" + b + "'); let hidden = element.getAttribute('hidden'); if (hidden) { element.removeAttribute('hidden'); } else { element.setAttribute('hidden', 'hidden'); } }; let togg" + b + " = () => { let element = document.getElementById('edtdata" + b + "'); let hidden = element.getAttribute('hidden'); if (hidden) { element.removeAttribute('hidden'); } else { element.setAttribute('hidden', 'hidden'); } } </script></div>");
        document.getElementById("addmeber").reset();

    }
}

function progressHandler(event) {
    // _("loaded_n_total").innerHTML = "Uploaded " + event.loaded + " bytes of " + event.total;
    var percent = (event.loaded / event.total) * 100;
    _("progressBar").value = Math.round(percent);
    _("status").innerHTML = Math.round(percent) + "%";
}

function completeHandler(event) {
    _("status").innerHTML = event.target.responseText;
    _("progressBar").value = 0; //wil clear progress bar after successful upload
}

function errorHandler(event) {
    _("status").innerHTML = "Upload Failed";
}

function abortHandler(event) {
    _("status").innerHTML = "Upload Aborted";
}