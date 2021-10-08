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

#alterar grupo
btn1 = browser.li(id: 'mainGroupNav').click

sleep 2
btn2 = browser.li(:id => 'manageGroupNav').click
browser.screenshot.save 'Screenshot/Grupo/Alteracao/AlterandoGrupos.png'

btn3 = browser.text_field(class: 'form-control input-sm')
btn3.exists?
btn3.set 'desiree'
#btn3.set 'none'
#btn3.set 'rural'
#btn3.set 'globo'
#btn3.set 'ccomp'
#btn3.set 'ufrrj'
#btn3.set 'dcc'
btn3.value
btn3.fire_event('onchange')
browser.screenshot.save 'Screenshot/Grupo/Alteracao/SelecionandoGrupo_Alterar_ct06.png'

browser.window.maximize
sleep 2
browser.div.click
sleep 2

btn4 = browser.link(:class => "btn btn-default").when_present.click
browser.screenshot.save 'Screenshot/Grupo/Alteracao/SelecionandoGrupo_Alterar_ct07.png'
sleep 2


#btn4 = browser.checkbox(value: 'deleteStore').next_sibling(tag_name: 'ins').click
#btn5 = browser.checkbox(value: 'updateOrder').next_sibling(tag_name: 'ins').click
#browser.screenshot.save 'Screenshot/Grupo/Alteracao/alterar_ct1.png'

#browser.screenshot.save 'Screenshot/Grupo/Alteracao/alterar_ct2.png'

#btn4 = browser.text_field(id: 'group_name')
#btn4.exists?
#btn4.set ''
#btn4.value
#btn4.fire_event('onchange')
#browser.screenshot.save 'Screenshot/Grupo/Alteracao/alterar_ct3.png'


#btn4 = browser.checkbox(value: 'deleteProduct').next_sibling(tag_name: 'ins').click
#browser.screenshot.save 'Screenshot/Grupo/Alteracao/alterar_ct4.png'


#btn4 = browser.text_field(id: 'group_name')
#btn4.exists?
#btn4.set 'rural_novo'
#btn4.value
#btn4.fire_event('onchange')
#btn5 = browser.checkbox(value: 'deleteCategory').next_sibling(tag_name: 'ins').click
#browser.screenshot.save 'Screenshot/Grupo/Alteracao/alterar_ct5.png'


#btn4 = browser.text_field(id: 'group_name')
#btn4.exists?
#btn4.set 'globoplay'
#btn4.value
#btn4.fire_event('onchange')
#btn5 = browser.checkbox(value: 'viewProfile').next_sibling(tag_name: 'ins').click
#btn6 = browser.checkbox(value: 'updateStore').next_sibling(tag_name: 'ins').click
#browser.screenshot.save 'Screenshot/Grupo/Alteracao/alterar_ct6.png'



btn4 = browser.text_field(id: 'group_name')
btn4.exists?
btn4.set 'amazon'
btn4.value
btn4.fire_event('onchange')
btn5 = browser.checkbox(value: 'updateStore').next_sibling(tag_name: 'ins').click
browser.screenshot.save 'Screenshot/Grupo/Alteracao/alterar_ct7.png'

browser.scroll.to :center
sleep 2

btn7 = browser.button(class: 'btn btn-primary').wait_until(&:enabled?)
btn7.fire_event('onclick')

sleep 2
browser.scroll.to :center
browser.screenshot.save 'Screenshot/Grupo/Alteracao/GrupoAlterado_ct7.png'
sleep 2
