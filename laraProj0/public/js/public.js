function togglePassword(inputId, eyeId) {
    const input = document.getElementById(inputId);
    const eye = document.getElementById(eyeId);
    
    if (input.type === 'password') {
        input.type = 'text';
        eye.src ="{{asset('images/eye-slash-solid.png')}}";
        eye.alt = 'Hide password';
    } else {
        input.type = 'password';
        eye.src = "{{asset('images/eye-solid.png')}}";
        eye.alt = 'Show password';
    }
}   