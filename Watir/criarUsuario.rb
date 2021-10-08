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

sleep 2
browser.screenshot.save 'Screenshot/Usuario/criandoUser_ct10.png'
btn2 = browser.li(:id => 'createUserNav').click

btn3 = browser.span(class: 'select2-selection__rendered').click
sleep 2


group = browser.text_field class: 'select2-search__field'
group.exists?
group.set 'ccomp'
group.value
group.fire_event('onchange')

sleep 2
btn4 = browser.li(class: 'select2-results__option select2-results__option--highlighted').click
sleep 2


btn5 = browser.text_field(id: 'username')
btn5.exists?
#btn5.set 'desiree'
#btn5.set 'desi'
#btn5.set 'monalisa'
btn5.set 'ruralina'
btn5.value
btn5.fire_event('onchange')

btn6 = browser.text_field(id: 'email')
btn6.exists?
#btn6.set 'desiree@hotmail.com'
#btn6.set 'desiree'
btn6.set 'rural@rural.com'
btn6.value
btn6.fire_event('onchange')

btn7 = browser.text_field(id: 'password')
btn7.exists?
#btn7.set 'desiree02'
#btn7.set 'de'
#btn7.set 'senhanova'
btn7.set 'senharural'
btn7.value
btn7.fire_event('onchange')

btn8 = browser.text_field(id: 'cpassword')
btn8.exists?
#btn8.set 'desiree02'
#btn8.set 'de'
#btn8.set 'de02'
#btn8.set 'senhanova'
btn8.set 'senharural'
btn8.value
btn8.fire_event('onchange')

sleep 2
browser.screenshot.save 'Screenshot/Usuario/PreenchendoUser_ct10.png'
browser.scroll.to :center
sleep 2

btn9 = browser.text_field(id: 'fname')
btn9.exists?
#btn9.set 'Desiree'
#btn9.set 'Andressa'
#btn9.set 'Monalisa'
btn9.set 'Natalia'
btn9.value
btn9.fire_event('onchange')

btn10 = browser.text_field(id: 'lname')
btn10.exists?
#btn10.set 'Araujo'
#btn10.set 'Fernandes'
btn10.set 'Oliveira'
btn10.value
btn10.fire_event('onchange')

btn11 = browser.text_field(id: 'phone')
btn11.exists?
#btn11.set '021'
btn11.set ''
btn11.value
btn11.fire_event('onchange')

btn12 = browser.radio id: 'female'
btn12.exists?
btn12.set
browser.screenshot.save 'Screenshot/Usuario/UsuarioPreenchido_ct10.png'

btn13 = browser.button(class: 'btn btn-primary').click
sleep 2
browser.screenshot.save 'Screenshot/Usuario/Usuario_ct10.png'