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
browser.screenshot.save 'Screenshot/Marca/sistema.png'
btn2 = browser.li(:id => 'brandNav').click
browser.screenshot.save 'Screenshot/Marca/Marcas_ct05.png'

btn4 = browser.button(:class => 'btn btn-primary').click
browser.screenshot.save 'Screenshot/Marca/PreenchendoMarca_ct05.png'

btn5 = browser.text_field(id: 'brand_name')
btn5.exists?
btn5.set 'rural'
#btn5.set 'ufrrj'
#btn5.set 'ccomp'
#btn5.set 'ufrrj_ni'
btn5.value
btn5.fire_event('onchange')

browser.screenshot.save 'Screenshot/Marca/MarcaPreenchida2_ct05.png'

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
browser.screenshot.save 'Screenshot/Marca/MarcaPreenchida3_ct05.png'
sleep 2
browser.div.click

btn8 = browser.button(:name => 'save').click

sleep 2

browser.screenshot.save 'Screenshot/Marca/MarcaCriada_ct05.png'

