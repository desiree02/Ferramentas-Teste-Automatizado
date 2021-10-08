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

btn = browser.button(class: 'btn btn-primary btn-block btn-flat').wait_until(&:enabled?)
btn.fire_event('onclick')


btn1 = browser.li(id: 'categoryNav').click

btn3 = browser.text_field(class: 'form-control input-sm')
btn3.exists?
btn3.set 'curso'
#btn3.set 'Active'
#btn3.set 'disciplina'
#btn3.set 'horario'
#btn3.set 'tv'
btn3.value
btn3.fire_event('onchange')

browser.screenshot.save 'Screenshot/Categoria/Alterar/Buscacategoria_ct06.png'

browser.div.click
sleep 2

btn4 = browser.button(:class => "btn btn-default").when_present.click
browser.screenshot.save 'Screenshot/Categoria/Alterar/MarcaEdit_ct06.png'
sleep 2


btn5 = browser.text_field(id: 'edit_category_name')
btn5.exists?
#btn5.set 'novos horarios'
#btn5.set ''
#btn5.set 'cinema'
btn5.set 'sala'
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
browser.screenshot.save 'Screenshot/Categoria/Alterar/MarcaEdit01_ct06.png'
sleep 2
browser.div.click
sleep 2

btn8= browser.button(:id => 'salvar').when_present.click

sleep 2

browser.screenshot.save 'Screenshot/Categoria/Alterar/MarcaAlterada_ct06.png'