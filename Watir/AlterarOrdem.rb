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
browser.screenshot.save 'Screenshot/Pedido/AlterarPedido/pedido_ct01.png'
btn2 = browser.li(:id => 'mainOrdersNav').click
btn2 = browser.li(:id => 'manageOrdersNav').click
browser.screenshot.save 'Screenshot/Pedido/AlterarPedido/alterandopedido_ct01.png'



btn3 = browser.text_field(class: 'form-control input-sm')
btn3.exists?
btn3.set 'vdv'
btn3.value
btn3.fire_event('onchange')
browser.screenshot.save 'Screenshot/Pedido/AlterarPedido/alterandopedido_ct02.png'

browser.div.click
sleep 2

#editar (ele não acha o lápis)
btn4 = browser.button(:class => "btn btn-default").when_present.click
browser.screenshot.save 'Screenshot/Pedido/AlterarPedido/alterandopedido_ct03.png'
sleep 2


btn5 = browser.text_field(id: 'customer_name')
btn5.exists?
btn5.set 'Desiree'
btn5.value
btn5.fire_event('onchange')

btn6 = browser.text_field(id: 'customer_address')
btn6.exists?
btn6.set 'Nilopolis'
btn6.value
btn6.fire_event('onchange')


btn7= browser.text_field(id: 'customer_phone')
btn7.exists?
btn7.set '0219875422'
btn7.value
btn7.fire_event('onchange')

btn8= browser.text_field(id: 'customer_phone')
btn8.exists?
btn8.set '0219875422'
btn8.value
btn8.fire_event('onchange')


btn9 = browser.span(class: 'select2-selection select2-selection--single').click
sleep 2
btn10 = browser.text_field(class: 'select2-search__field')
btn10.exists?
btn10.set 'Bolsa'
btn10.value
sleep 2
btn10.fire_event('onchange')
sleep 2

browser.screenshot.save 'Screenshot/Pedido/AlterarPedido/alterandopedido2_ct01.png'

browser.div.click
sleep 2


btn11 = browser.text_field(id: 'qty_1')
btn11.exists?
btn11.set '2'
btn11.value
btn11.fire_event('onchange')
sleep 2

browser.screenshot.save 'Screenshot/Pedido/AlterarPedido/alterandopedido3_ct02.png'

btn8 = browser.button(:class => 'btn btn-primary').click

sleep 2

browser.screenshot.save 'Screenshot/Pedido/AlterarPedido/alterandopedido4_ct01.png'