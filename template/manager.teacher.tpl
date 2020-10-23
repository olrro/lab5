<div class="container">

    <h1 class="mt-5">

        [add]Новый педагог[/add]
        [edit]Изменить[/edit]
        <a href="/manager/teacher[edit]/{id}[/edit]#start" id="start">
          <i class="fas fa-[add]plus[/add][edit]highlighter[/edit]"></i>
        </a>

    </h1>

    <p class="lead mb-5">
        [add]Добавить нового преподавателя в базу данных. Преподаватель появиться на отдельной странице[/add]
        [edit]Здесь вы можете отредактировать уже существующего преподавателя[/edit]
    </p>

    [edit]
    <form method="POST">

        <input type="hidden" name="remove" value="{id}" />
        
        <div class="card my-5 bg-primary overflow-hidden p-4 border-0 shadow rounded-lg">
            <div class="row justify-content-md-start align-items-md-center" style="z-index: 1;">
                <div class="col-auto ml-auto d-none d-md-block">
                    <img src="{foto}" width="140px" height="140px" class="bg-white rounded-circle my-2 p-1" alt="" />
                </div>
                <div class="col text-white">
                    <div class="d-flex h3 mb-1">
                        <span>
                            {name} <button class="btn btn-link p-0" type="submit" name="button"><i class="fas fa-trash-alt text-danger h4"></i></button>
                        </span>
                    </div>
                    <p>
                        Стаж преподавания - <b>{experience}</b> <br />
                        ID наставника - <b>{id}</b>
                    </p>
                </div>
            </div>
            <figure class="position-absolute m-0" style="bottom: 0; right: 0; left: 0;">
                <svg preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 1921 253">
                    <polygon fill="#fff" points="0,273 1921,273 1921,0 "></polygon>
                </svg>
            </figure>
        </div>

    </form>
    [/edit]

    <h4 class="my-5 text-center border-left py-4 border-separator"><span class="text-primary">Д</span>оступные поля</h4>

    <form method="POST" enctype="multipart/form-data" id="mainForm">

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="inputName">Имя</label>
                    <input type="text" class="form-control" name="name" id="inputName" minlength="5" maxlength="25" placeholder="Алексей Бишкеков" value="{name}" autocomplete="off" required />
                    <div class="invalid-feedback">Допустимы только буквы из русского, английского алфавита и пробел. Минимум - 5 символов</div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="inputDate">Стаж преподавания (укажите дату начала работы)</label>
                    <input type="date" class="form-control" min="1900-01-01" max="2005-01-01" name="date" id="inputDate" placeholder="гггг-мм-дд" value="{experience-start}" autocomplete="off" required />
                    <div class="invalid-feedback">Формат ввода даты гггг-мм-дд (например 2016-12-10)</div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label for="inputPhoto">Загрузить аватар</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fas fa-file"></i> </span>
                        </div>
                        <div class="custom-file">
                            <input type="file" accept="image/jpeg, image/png" name="photo" class="custom-file-input" id="inputPhoto" [add]required[/add]>
                            <label class="custom-file-label" for="inputPhoto" data-browse="Аватар"> [add].JPG или .PNG до 1MB[/add] {foto-file} </label>
                        </div>
                    </div>
                </div>
            </div>

            [edit]
            <div class="col-12">
                <div class="form-group">
                    <label for="photoBan">Настройки аватара</label>
                    <div class="form-check">
                        <input class="form-check-input" name="photoban" type="checkbox" id="photoBan" checked />
                        <label class="form-check-label" for="photoBan">
                            Не изменять аватар
                        </label>
                    </div>
                </div>
            </div>
            [/edit]

            <div class="col-12">
                <div class="form-group">
                    <label for="inputBio">Личная биография</label>
                    <textarea class="form-control" name="bio" id="inputBio" rows="5" minlength="5" placeholder="Подробно опишите преподавателя. Его жизненные принципы, увлечения и т.д." maxlength="2000" style="resize: none;" autocomplete="off" required>{biography}</textarea>
                    <div class="invalid-feedback">Разрешены только буквы английского или русского алфавита, а также запятая, пробел, точка и цифры от 0 до 9. Минимум - 5 символов</div>
                </div>
            </div>
        </div>

        [edit]
        <input type="hidden" name="id" value="{id}" />
        [/edit]

        <div class="btn-group animate__animated animate__headShake w-100 my-4">
            <a href="/manager" class="btn btn-lg btn-outline-primary"><i class="fas fa-arrow-left"></i></a>
            <button type="submit" class="btn btn-lg btn-primary">Отправить</button>
        </div>
    </form>

    <p>Вернуться на <a href="/">главную страницу</a></p>

</div>

<script type="text/javascript">

  $( '#mainForm' ).submit( function( event ) {

    event.preventDefault();

    let may_send = 1

    $( 'form' ).find( ':input' ).removeClass( 'is-invalid' );

    if ( !/^[А-Яа-яЁёA-Za-z\s]+$/iu.test( $( '#inputName' ).val() ) || $( '#inputName' )[0].length < 5 || $( '#inputName' )[0].length > 25 ) {
      $( '#inputName' ).addClass( 'is-invalid' );
      may_send = 0
    }

    if ( !/^[А-Яа-яЁёA-Za-z0-9\s.,]+$/iu.test( $( '#inputBio' ).val() ) || $( '#inputBio' )[0].length < 5 || $( '#inputBio' )[0].length > 2000 ) {
      $( '#inputBio' ).addClass( 'is-invalid' );
      may_send = 0
    }

    if ( !/^\d{4}-\d{2}-\d{2}$/.test( $( '#inputDate' ).val() ) ) {
      $( '#inputDate' ).addClass( 'is-invalid' );
      may_send = 0
    }


    if ( $('#photoBan').length ) {

      if ( !$( '#photoBan' ).is(':checked') ) {

        if ( $( '#inputPhoto' )[0].files.length === 0 ) {
          $( '#inputPhoto' ).addClass( 'is-invalid' );
          may_send = 0
        }

      }

    }

    if ( may_send ) {
      this.submit();
    }

  });

</script>
