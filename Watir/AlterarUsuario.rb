require 'watir'
require "watir/wait"

browser = Watir::Browser.new :chrome
browser.goto('localhost/stock')

email = browser.text_field id: 'email'
email.exists?
email.set 'admin@admin.com'
email.value
email.fire_event('onchange')

senha = browser.text_field id: 'password'
senha.exists?
senha.set 'password'
senha.value
senha.fire_event('onchange')

browser.window.maximize

btn = browser.button(class: 'btn btn-primary btn-block btn-flat').wait_until(&:enabled?)
btn.fire_event('onclick')

btn1 = browser.span(class: 'pull-right-container').wait_until(&:enabled?)
btn1.fire_event('onclick')


btn2 = browser.li(:id => 'manageUserNav').click
sleep 2
browser.screenshot.save 'Screenshot/Usuario/Alterar/Users.png'

btn3 = browser.text_field(class: 'form-control input-sm')
btn3.exists?
#btn3.set 'desiree'
#btn3.set 'none'
#btn3.set 'desiree@hotmail.com'
#btn3.set '021345778' 
#btn3.set 'rural' 
#btn3.set 'and'
btn3.set 'lucas'
btn3.value
btn3.fire_event('onchange')
browser.screenshot.save 'Screenshot/Usuario/Alterar/Users_Alterar_ct09.png'

browser.div.click
sleep 2

btn4 = browser.link(:class => "btn btn-default").when_present.click
browser.screenshot.save 'Screenshot/Usuario/Alterar/Users_AlterSelecionado_ct09.png'
sleep 2


group = browser.text_field class: 'select2-search__field'
group.exists?
#group.set 'ccomp'
#group.set ''
#group.set 'Melo'
group.set 'grupo02'
group.value
group.fire_event('onchange')

sleep 2
btn4 = browser.li(class: 'select2-results__option select2-results__option--highlighted').click
sleep 2


btn5 = browser.text_field(id: 'username')
btn5.exists?
#btn5.set 'desiree01'
#btn5.set 'desiree' 
btn5.set 'de@de' 
btn5.value
btn5.fire_event('onchange')
browser.screenshot.save 'Screenshot/Usuario/Alterar/Users_AlterSelecionado1_ct09.png'


btn6 = browser.text_field(id: 'email')
btn6.exists?
#btn6.set ''
#btn6.set 'de@de' 
btn6.set 'rural'
btn6.value
btn6.fire_event('onchange')


btn9 = browser.text_field(id: 'fname')
btn9.exists?
#btn9.set ''
btn9.set 'Desiree'
btn9.value
btn9.fire_event('onchange')


btn10 = browser.text_field(id: 'lname')
btn10.exists?
btn10.set ''
btn10.value
btn10.fire_event('onchange')

btn11 = browser.text_field(id: 'phone')
btn11.exists?
btn11.set '021'
btn11.set ''
btn11.value
btn11.fire_event('onchange')


btn12 = browser.radio id: 'male'
btn12.exists?
btn12.set
browser.screenshot.save 'Screenshot/Usuario/UsuarioPreenchido_ct5.png'


btn7 = browser.text_field(id: 'password')
btn7.exists?
btn7.set ''
#btn7.set '021345778'
#btn7.set 'seeenha02'
btn7.set 'senha02'
btn7.value
btn7.fire_event('onchange')


btn8 = browser.text_field(id: 'cpassword')
btn8.exists?
btn8.set ''
#btn8.set '021345778'
#btn8.set 'seeenha03'
#btn8.set 'senha02'
btn8.value
btn8.fire_event('onchange')

sleep 2
browser.screenshot.save 'Screenshot/Usuario/Alterar/PreenchendoUser_ct09.png'
browser.scroll.to :center
sleep 2


btn13 = browser.button(class: 'btn btn-primary').click
sleep 2
browser.screenshot.save 'Screenshot/Usuario/Alterar/UsuarioAlteradoFinal_ct09.png'