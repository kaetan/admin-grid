$(document).ready(function () {
   $('.js-cache-clear').click(function () {
      $.ajax({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         type: "post",
         url: "/cache-clear",
         success: function (data) {
            if (data.result) {
               alert('Очистка кэша завершена!');
            }
         },
         error: function (data) {
            alert('Произошла непредвиденная ошибка, попробуйте перезагрузить страницу');
         },
      });
   });
});