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

sleep 2
browser.screenshot.save 'Screenshot/Loja/sistema.png'
btn2 = browser.li(:id => 'storeNav').click
browser.screenshot.save 'Screenshot/Loja/Lojas_ct04.png'

btn4 = browser.button(:class => 'btn btn-primary').click
browser.screenshot.save 'Screenshot/Loja/PreenchendoLoja_ct04.png'

btn5 = browser.text_field(id: 'store_name')
btn5.exists?
#btn5.set 'Araujo Store'
btn5.set 'Mc Donalds'
btn5.set 'Burguer King'
btn5.set ''
btn5.value
btn5.fire_event('onchange')

browser.screenshot.save 'Screenshot/Loja/LojaPreenchida2_ct04.png'

browser.div.click
sleep 2

btn6 = browser.select_list(name: 'active').click
btn7 = browser.select_list(name: 'active')
btn7.exists?
btn7.select 'Active'
#btn7.select 'Inactive'
btn7.selected_options
btn7.fire_event('onchange')

sleep 2
browser.screenshot.save 'Screenshot/Loja/LojaPreenchida3_ct04.png'
sleep 2
browser.div.click

btn8 = browser.button(:name => 'salvar').click

sleep 2

browser.screenshot.save 'Screenshot/Loja/LojaCriada_ct04.png'

