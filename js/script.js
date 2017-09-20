document.addEventListener('DOMContentLoaded', function() {

  document.querySelector('form').onsubmit = function() {
    event.preventDefault();
    requestData(this);
  };

});

function requestData(form) {
  let formData = new FormData(form),
    url = form.getAttribute('action'),
    method = form.getAttribute('method'),
    xhr = new XMLHttpRequest;

  xhr.open(method, url, true);
  xhr.send(formData);

  // console.log(formData.getAll());
  xhr.onreadystatechange = function() {
    if (this.readyState != 4) return;

    if (xhr.status != 200) {
      console.log( xhr.status + ': ' + xhr.statusText );
    } else {
      try {
        let data = JSON.parse(xhr.responseText);

        new Function(data['js'])();
      } catch(err) {
        alert('Что-то пошло не так.');
      }
    }
  }
}
