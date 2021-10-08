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
browser.screenshot.save 'Screenshot/Loja/Excluir/Lojas_ct01.png'

btn3 = browser.text_field(class: 'form-control input-sm')
btn3.exists?
btn3.set 'Burguer King'
#btn3.set 'Active'
#btn3.set 'Mc Donalds'
btn3.value
btn3.fire_event('onchange')
browser.screenshot.save 'Screenshot/Loja/Excluir/BuscaLoja_ct01.png'

browser.div.click
sleep 2

btn4 = browser.button(:class => "btn btn-default").when_present.click
browser.screenshot.save 'Screenshot/Loja/Excluir/LojaExcluir_ct01.png'
sleep 2

#NAO TA ENCONTRANDO A LIXEIRA
btn4 = browser.button(:class => 'btn btn-default', :id => "#removeModal").when_present.click
browser.screenshot.save 'Screenshot/Loja/Excluir/MarcaExclusao_ct01.png'
sleep 2

btn8= browser.button(:id => 'salvar').when_present.click

sleep 2

browser.screenshot.save 'Screenshot/Loja/Excluir/MarcaAlterada_ct01.png'

