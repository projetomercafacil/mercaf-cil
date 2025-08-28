function showForm(form) {
    document.getElementById('login').classList.remove('active');
    document.getElementById('register').classList.remove('active');
    document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
    if(form === 'login') {
        document.getElementById('login').classList.add('active');
        document.querySelectorAll('.tab')[0].classList.add('active');
    } else {
        document.getElementById('register').classList.add('active');
        document.querySelectorAll('.tab')[1].classList.add('active');
    }
}
