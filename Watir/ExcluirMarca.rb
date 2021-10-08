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
browser.screenshot.save 'Screenshot/Marca/Excluir/sistema.png'
btn2 = browser.li(:id => 'brandNav').click
browser.screenshot.save 'Screenshot/Marca/Excluir/Marcas_ct01.png'


btn3 = browser.text_field(class: 'form-control input-sm')
btn3.exists?
btn3.set 'ufrrj'
#btn3.set 'Active'
#btn3.set 'ufrrj_ni'
#btn3.set 'ccomp'
#btn3.set 'globo'
btn3.value
btn3.fire_event('onchange')
browser.screenshot.save 'Screenshot/Marca/Excluir/BuscaMarca_ct01.png'

browser.div.click
sleep 2

# NAO TA ENCONTRANDO A LIXEIRA, VERIFICAR
btn4 = browser.div(:class => 'btn btn-default', :data_target => '#removeBrandModal').when_present.click
browser.screenshot.save 'Screenshot/Marca/Excluir/MarcaSelecionadaExcluir_ct01.png'
sleep 2

btn8= browser.button(:name => 'save').when_present.click

sleep 2

browser.screenshot.save 'Screenshot/Marca/Excluir/MarcaExluida_ct01.png'

