// posting the form
const postForm = (url, formid, whereToDisplayMessage) => {
    const form = document.forms[formid];
    let formData = new FormData(form);
    axios.post(url, formData).then(response => {
        let message = response.data.message;

        if(Array.isArray(message)){
            message = message.join('<br>');
        }

        if (response.data.status === 'success') {
            $(whereToDisplayMessage).html("<div class='alert alert-success mt-5' role='alert'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span>" + message + "</div>");
            $(whereToDisplayMessage).fadeIn(500).delay(3000).fadeOut(500);
            form.reset();
        } else {
            $(whereToDisplayMessage).html("<div class='alert alert-danger mt-5' role='alert'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>"+ message +"</div>");
            $(whereToDisplayMessage).fadeIn(500).delay(3000).fadeOut(500);
        }
    });
}

