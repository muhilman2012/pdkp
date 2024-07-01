$('#btn-slider').click(function(){
    if($('#sliders').hasClass('active')){
        $('#sliders').removeClass('active');
        $('#sliders-background').removeClass('active');
    } else {
        $('#sliders').addClass('active');
        $('#sliders-background').addClass('active');
    }
});


$('#sliders-background').click(function(){
    $('#sliders').removeClass('active');
    $('#sliders-background').removeClass('active');
});

$('.btnLogout').click(() => {
    Swal.fire({
        title: 'Apa anda yakin?',
        text: "Keluar dari halaman Admin!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#716D66',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, keluar',
        cancelButtonText: 'Tidak!'
      }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '/admin/logout';
        }
      })
});
