// select2
$(document).ready(function() {
    $('.select2').select2({
      width: '100%'
    });
  });
  
  
  // انتخاب دکمه حذف فروشگاه
  var deleteBtns = document.querySelectorAll('.delete-record');
  
  deleteBtns.forEach((btn, i) => {
      // event handler یا  Event Listener
      btn.addEventListener('click', function () {
          // console.log('salam' + i);
  
          //swal
          swal({
              title: "آیا مطمئن هستید؟",
              text: "در صورت پاک کردن امکان بازیابی اطلاعات وجود ندارد!",
              icon: "warning",
              buttons: true,
              dangerMode: true,
              buttons: {
                  cancel: "انصراف",
                  ok: "تایید",
              },
            })
            .then((willDelete) => {
              // if click on delete btn
              if (willDelete) {
                // console.log(btn.parentElement.submit());
                btn.parentElement.submit()
              } else {
                swal("چیزی پاک نشد!");
              }
            });
      });
  
  });
  
  
  
  