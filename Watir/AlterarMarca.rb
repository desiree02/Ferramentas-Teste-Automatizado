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
browser.screenshot.save 'Screenshot/Marca/Alterar/sistema.png'
btn2 = browser.li(:id => 'brandNav').click
browser.screenshot.save 'Screenshot/Marca/Alterar/Marcas_ct06.png'


btn3 = browser.text_field(class: 'form-control input-sm')
btn3.exists?
btn3.set 'ufrrj'
#btn3.set 'Active'
#btn3.set 'ufrrj_ni'
#btn3.set 'ccomp'
#btn3.set 'globo'
btn3.value
btn3.fire_event('onchange')
browser.screenshot.save 'Screenshot/Marca/BuscaMarca_ct05.png'

browser.div.click
sleep 2

btn4 = browser.button(:class => "btn btn-default").when_present.click
browser.screenshot.save 'Screenshot/Marca/Alterar/MarcaEdit_ct06.png'
sleep 2

btn5 = browser.text_field(id: 'edit_brand_name')
btn5.exists?
btn5.set 'ccomp'
#btn5.set ''
#btn5.set 'ccomp2'
#btn5.set 'rede globo'
#btn5.set 'gnt'
btn5.value
btn5.fire_event('onchange')


btn6 = browser.select_list(id: 'edit_active').click
btn7 = browser.select_list(id: 'edit_active')
btn7.exists?
btn7.select 'Active'
#btn7.select 'Inactive'
btn7.selected_options
btn7.fire_event('onchange')

sleep 2
browser.screenshot.save 'Screenshot/Marca/Alterar/MarcaEdit01_ct06.png'
sleep 2
browser.div.click
sleep 2

btn8= browser.button(:id => 'savechanges').when_present.click

sleep 2

browser.screenshot.save 'Screenshot/Marca/Alterar/MarcaAlterada_ct06.png'

