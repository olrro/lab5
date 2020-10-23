<div class="container my-5">
    <h1 class="mt-5">
        Поиск <a href="/search#start" id="start"><i class="fas fa-search"></i></a>
    </h1>

    <p class="lead mb-5">
        Ищите материалы в нашей коллекции для обучения студентов. Результаты поиска выводятся мгновенно. Запрос не должен быть пустым, превышать 150 символов и быль меньше 5 символов.
    </p>

    <form method="POST">
        <div class="form-group row">
            <label for="searchField" class="col-xl-2 col-form-label col-form-label-lg">Введите запрос</label>
            <div class="col-xl-10">
                <div class="input-group mb-3">
                    <input type="text" name="request" class="form-control form-control-lg" id="searchField" autocomplete="off" required />
                    <div class="input-group-append">
                        <button class="btn btn-primary btn-lg" type="submit" id="startSearch">Искать</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div style="display: none;" id="placeholder">
        <div class="d-flex justify-content-center align-items-center my-5">
            <i class="fas display-4 fa-circle-notch fa-spin"></i>
            <h5 class="ml-3">Выполняется поиск</h5>
        </div>
    </div>

    <div id="results">
        {results}
    </div>

    <script type="text/javascript">

    $( 'form' ).submit( function( event ){

      event.preventDefault();

      $( 'form' ).find( ':input:not(:disabled)' ).prop( 'disabled', 1 );

      $( '#placeholder' ).fadeIn( 'fast' );
      $( '#results' ).html('').hide();


      $.ajax({
          type: 'POST',
          url: '/ajax/search.php',
          data: {
            request: $( '#searchField' ).val()
          },
          success: function(data){

            $( '#placeholder' ).fadeOut( 'fast', function(){
              $( 'form' ).find( ':input(:disabled)' ).prop( 'disabled', 0 );
              $( '#results' ).prepend( data ).fadeIn( 'fast' );
            });


          },
          error: function() {
              alert( 'Произошла ошибка, попробуйте позже' );
          }
      });

    });

    </script>
</div>
