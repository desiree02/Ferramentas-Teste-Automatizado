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
browser.screenshot.save 'Screenshot/Usuario/Exclusao/Users.png'

btn3 = browser.text_field(class: 'form-control input-sm')
btn3.exists?
#btn3.set 'joana'
#btn3.set 'ufrrj' 
#btn3.set '021987653456' 
btn3.set 'desiree@hotmail.com' 
btn3.value
btn3.fire_event('onchange')
browser.screenshot.save 'Screenshot/Usuario/Exclusao/Users_Excluir_ct04.png'

browser.div.click
sleep 2


btn4 = browser.link(:name => "delete").when_present.click
browser.screenshot.save 'Screenshot/Usuario/Exclusao/Users_ConfirmaExclusao_ct04.png'
sleep 2

#CONFIRM
btn7 = browser.button(name: 'confirm').wait_until(&:enabled?)
btn7.fire_event('onclick')
browser.screenshot.save 'Screenshot/Usuario/Exclusao/Users_Excluindo_ct03.png'
sleep 2
browser.scroll.to :center
browser.screenshot.save 'Screenshot/Usuario/Exclusao/Users_Excluido_ct3.png'


#CANCEL
btn7 = browser.link(:class  => "btn btn-warning").when_present.click
browser.screenshot.save 'Screenshot/Grupo/Exclusao/Excluindo_ct4.png'
sleep 2
browser.scroll.to :center
browser.screenshot.save 'Screenshot/Grupo/Exclusao/Excluido_ct4.png'

