function togglePassword(inputId, eyeId) {
    const input = document.getElementById(inputId);
    const eye = document.getElementById(eyeId);
    
    if (input.type === 'password') {
        input.type = 'text';
        eye.src = "{{asset('images/eye-slash-solid.png')}}";
    } else {
        input.type = 'password';
        eye.src = "{{asset('images/eye-solid.png')}}";
    }
}   