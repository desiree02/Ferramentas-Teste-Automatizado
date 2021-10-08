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

#criar grupo
btn1 = browser.li(id: 'mainGroupNav').click

sleep 2
btn2 = browser.li(:id => 'addGroupNav').click
browser.screenshot.save 'Screenshot/Grupo/PreenchendoGrupo.png'

btn3 = browser.text_field(id: 'group_name')
btn3.exists?
#btn3.set 'desiree'
#btn3.set 'rural'
#btn3.set 'andressa'
#btn3.set 'joana'
#btn3.set 'ccomp'
#btn3.set 'ufrrj'
btn3.set 'dcc'
btn3.value
btn3.fire_event('onchange')
browser.screenshot.save 'Screenshot/Grupo/GrupoPreenchido2_ct8.png'

browser.window.maximize

browser.div.click
sleep 2

#btn4 = browser.checkbox(value: 'createUser').next_sibling(tag_name: 'ins').click
#btn5 = browser.checkbox(value: 'createGroup').next_sibling(tag_name: 'ins').click
#btn6 = browser.checkbox(value: 'updateBrand').next_sibling(tag_name: 'ins').click
#browser.screenshot.save 'Screenshot/Grupo/checkbox.png'

#btn4 = browser.checkbox(value: 'updateStore').next_sibling(tag_name: 'ins').click
#btn5 = browser.checkbox(value: 'viewOrder').next_sibling(tag_name: 'ins').click
#btn6 = browser.checkbox(value: 'viewReports').next_sibling(tag_name: 'ins').click
#browser.screenshot.save 'Screenshot/Grupo/checkbox_ct3.png'

#btn4 = browser.checkbox(value: 'deleteGroup').next_sibling(tag_name: 'ins').click
#browser.screenshot.save 'Screenshot/Grupo/checkbox_ct4.png'

#btn4 = browser.checkbox(value: 'viewProduct').next_sibling(tag_name: 'ins').click
#browser.screenshot.save 'Screenshot/Grupo/checkbox_ct5.png'

#btn4 = browser.checkbox(value: 'createCategory').next_sibling(tag_name: 'ins').click
#btn5 = browser.checkbox(value: 'createOrder').next_sibling(tag_name: 'ins').click
#btn6 = browser.checkbox(value: 'createProduct').next_sibling(tag_name: 'ins').click
#btn7 = browser.checkbox(value: 'updateCategory').next_sibling(tag_name: 'ins').click
#btn8 = browser.checkbox(value: 'updateOrder').next_sibling(tag_name: 'ins').click
#btn9 = browser.checkbox(value: 'updateProduct').next_sibling(tag_name: 'ins').click
#btn10 = browser.checkbox(value: 'viewCategory').next_sibling(tag_name: 'ins').click
#btn11 = browser.checkbox(value: 'viewOrder').next_sibling(tag_name: 'ins').click
#btn12 = browser.checkbox(value: 'viewProduct').next_sibling(tag_name: 'ins').click
#btn13 = browser.checkbox(value: 'deleteProduct').next_sibling(tag_name: 'ins').click
#btn14 = browser.checkbox(value: 'deleteOrder').next_sibling(tag_name: 'ins').click
#btn15 = browser.checkbox(value: 'deleteCategory').next_sibling(tag_name: 'ins').click
#browser.screenshot.save 'Screenshot/Grupo/checkbox_ct6.png'

#btn4 = browser.checkbox(value: 'createOrder').next_sibling(tag_name: 'ins').click
#browser.screenshot.save 'Screenshot/Grupo/checkbox_ct7.png'

btn4 = browser.checkbox(value: 'viewReports').next_sibling(tag_name: 'ins').click
browser.screenshot.save 'Screenshot/Grupo/checkbox_ct8.png'

browser.scroll.to :center
sleep 2

btn7 = browser.button(class: 'btn btn-primary').wait_until(&:enabled?)
btn7.fire_event('onclick')

sleep 2
browser.scroll.to :center
browser.screenshot.save 'Screenshot/Grupo/novoGrupo_ct8.png'
sleep 2
