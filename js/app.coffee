class App
  constructor: ->
    $.ajaxSetup cache: false
    @init()
    @set_bindings()
        
  init: () ->
    @chat_id = $('#send_question').attr('data-chat-id')
    @check_cookie()

  set_bindings: () ->
    $('#enter').click (e) =>
      e.preventDefault()
      @validate_user()
    $('#send_question').click (e) =>
      e.preventDefault()
      @send_question()
    $('#logout').click (e) =>
      e.preventDefault()
      @logout()

  
  validate_user: () ->
    $('#alert_box').hide()
    name = $('#username').val()
    if name is ''
       $('#alert_box').show()
       $('#alert_text').show().text 'Debe ingresar todos los datos'
    else
      @set_cookie(name)
      @create_user(name)
      @show_questions_area(name)
      @get_questions()

  create_user: (name) ->

      usuario = {}
      usuario.username = name
      $.post('http://plataforma.biialab.org/api/register.json', usuario)
        .always (data) =>
          @usuario_id = data.userid

  set_cookie: (name) -> $.cookie("_sess_cht_mdstrm", "#{name}")

  check_cookie: () -> 
    if $.cookie("_sess_cht_mdstrm")
      user_data = $.cookie("_sess_cht_mdstrm")
      @show_questions_area(user_data)
      @get_questions()
    else
      $('#register_fields').show()

  show_questions_area: (name) ->
    $('#question_text').attr 'placeholder', $('#question_text').attr('placeholder').replace('%name%', name)
    $('#question_user').val name
    $('#register_fields').hide()
    $('#questions_box').show()

  get_questions: () ->
    $.getJSON("http://plataforma.biialab.org/aula/jupiter/apiNew.php?action=getChatConversation&courseId=1308&sessionId=1&ide=126288")
    .always (data) =>
      $('#questions').empty()
      if data?
        $('#questions')
        for question in (data or [])
          li = $('<li/>')
          li.append $('<span/>').text question.userName
          li.append $('<p/>').text question.text
          $('#questions').append li
    @timeout_questions = to 10000, () => @get_questions()

  send_question: () ->

    text = $('#question_text').val();

    params = '{
      "data": {
        "event": "conversationCreate",
        "data": {
          "channel": "1308-1",
          "courseId": "1308",
          "sessionId": "1",
          "text": "'+text+'"
        }
      }
    }'


    if params isnt ''
      console.log(@usuario_id)
      $.post("http://plataforma.biialab.org/aula/jupiter/apiNew.php?action=newChatMessage&ide=#{@usuario_id}", params)
      .always (data) =>
        $('#question_text').val ''
        clearTimeout @timeout_questions
        @get_questions()
    else
      $('#alert_box').show()
      $('#alert_text').show().text 'Debe ingresar un mensaje'

  logout: () ->
    $.removeCookie '_sess_cht_mdstrm'
    $('#question_user').val ''
    $('#username').val ''
    $('#question_text').attr 'placeholder', '%name%, ingrese su pregunta acá'
    $('#question_text').val ''
    $('#questions_box').hide()
    $('#register_fields').show()
    $('#questions').empty()

to = (t, cb) -> setTimeout cb, t

$ () -> new App
