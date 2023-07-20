Custom = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    showCloseButton: true,
    timer: 3000,
    timerProgressBar: true,
    keydownListenerCapture: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});
Custom2 = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: true,
    showCloseButton: false,
    timer: 3000,
    timerProgressBar: true,
})