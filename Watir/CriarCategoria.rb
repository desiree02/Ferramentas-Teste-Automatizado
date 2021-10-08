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

sleep 2
btn2 = browser.button(:name => 'add_category').click
browser.screenshot.save 'Screenshot/Categoria/inicio_ct04.png'

btn3 = browser.text_field(id: 'category_name')
btn3.exists?
#btn3.set 'curso'
#btn3.set 'disciplina'
#btn3.set 'horario'
btn3.set ''
btn3.value
btn3.fire_event('onchange')
browser.screenshot.save 'Screenshot/Categoria/PreenchendoCategoria_ct04.png'

browser.window.maximize

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

browser.screenshot.save 'Screenshot/Categoria/PreenchendoCategoria1_ct04.png'
sleep 2
browser.div.click

btn8 = browser.button(:name => 'save').click

sleep 2

browser.screenshot.save 'Screenshot/Categoria/CategoriaCriada_ct04.png'