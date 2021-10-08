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
btn3.set 'novos horarios'
btn3.value
btn3.fire_event('onchange')

browser.screenshot.save 'Screenshot/Categoria/Excluir/Buscacategoria_ct01.png'

browser.div.click
sleep 2

#NAO TA ENCONTRANDO A LIXEIRA
btn4 = browser.button(:class => 'btn btn-default', :id => "#removeModal").when_present.click
browser.screenshot.save 'Screenshot/Categoria/Excluir/MarcaExclusao_ct01.png'
sleep 2

btn8= browser.button(:id => 'salvar').when_present.click

sleep 2

browser.screenshot.save 'Screenshot/Categoria/Alterar/MarcaAlterada_ct06.png'