<div class="container">

    <h1 class="mt-5">

        [add]Новый студент[/add]
        [edit]Изменить[/edit]
        <a href="/manager/student[edit]/{id}[/edit]#start" id="start">
          <i class="fas fa-[add]plus[/add][edit]highlighter[/edit]"></i>
        </a>

    </h1>

    <p class="lead mb-5">
        [add]Вы можете создать нового студента и привязать к нему существующего преподавателя[/add]
        [edit]Здесь вы можете отредактировать уже существующего студента[/edit]
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
                        Дата рождения студента - <b>{birthday}</b> <br />
                        Пол - <b>{gender}</b>
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
            <div class="col-md-4">
                <div class="form-group">
                    <label>
                        <a href="/teachers" class="text-decoration-none" target="_blank">ID преподавателя <i class="fas fa-question-circle"></i></a>
                    </label>
                    <input type="number" class="form-control" name="teacher_id" id="inputID" value="{teacher_id}" min="1" min="10000" placeholder="Числовое значение" autocomplete="off" required />
                    <div class="invalid-feedback">Допустимо число от 1 до 10000</div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="inputName">Имя</label>
                    <input type="text" class="form-control" name="name" id="inputName" value="{name}" minlength="5" maxlength="25" placeholder="Кирилл Дуров" autocomplete="off" required />
                    <div class="invalid-feedback">Допустимы только буквы из русского, английского алфавита и пробел. Минимум - 5 символов</div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="inputDate">Дата рождения</label>
                    <input type="date" class="form-control" min="1900-01-01" value="{birthday}" max="2005-01-01" name="date" id="inputDate" placeholder="гггг-мм-дд" autocomplete="off" required />
                    <div class="invalid-feedback">Формат ввода даты гггг-мм-дд (например 2000-12-22)</div>
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
                            <label class="custom-file-label" for="inputPhoto" data-browse="Аватар"> [add].JPG или .PNG до 1MB[/add] {foto-file}</label>
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
                    <label>Выберите пол</label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="inputGender1" value="1" {gender-male} required />
                            <label class="form-check-label" for="inputGender1">Мужской</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="inputGender2" value="0" {gender-female} />
                            <label class="form-check-label" for="inputGender2">Женский</label>
                        </div>
                    </div>
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

    if ( !/^\d{4}-\d{2}-\d{2}$/.test( $( '#inputDate' ).val() ) ) {
      $( '#inputDate' ).addClass( 'is-invalid' );
      may_send = 0
    }

    if ( parseInt( $( '#inputID' ).val() ) > 10000 || parseInt( $( '#inputID' ).val() ) < 1  ) {
      $( '#inputID' ).addClass( 'is-invalid' );
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
