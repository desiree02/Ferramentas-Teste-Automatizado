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

#criar produto
btn1 = browser.li(id: 'mainProductNav').click

sleep 2
browser.screenshot.save 'Screenshot/Produto/CriarProduto/produtos_ct01.png'
btn2 = browser.li(:id => 'addProductNav').click

group = browser.text_field name: 'product_name'
group.exists?
group.set 'Bolsa'
group.value
group.fire_event('onchange')

browser.div.click
sleep 2


btn5 = browser.text_field(id: 'sku')
btn5.exists?
btn5.set '12345'
#btn5.set 'desi'
#btn5.set 'monalisa'
#btn5.set 'ruralina'
btn5.value
btn5.fire_event('onchange')

btn6 = browser.text_field(id: 'price')
btn6.exists?
btn6.set '20,00'
#btn6.set 'desiree'
#btn6.set 'rural@rural.com'
btn6.value
btn6.fire_event('onchange')

btn7 = browser.text_field(id: 'qty')
btn7.exists?
btn7.set '20'
#btn7.set 'de'
#btn7.set 'senhanova'
#btn7.set 'senharural'
btn7.value
btn7.fire_event('onchange')

browser.div.click
sleep 2
browser.screenshot.save 'Screenshot/Produto/CriarProduto/preenchendo_ct01.png'

=begin
btn8 = browser.textarea(id: 'description')
btn8.exists?
btn8.set ''
#btn8.set 'de'
#btn8.set 'de02'
#btn8.set 'senhanova'
#btn8.set 'senharural'
btn8.value
btn8.fire_event('onchange')

sleep 2
browser.screenshot.save 'Screenshot/Produto/CriarProduto/produtos_ct01.png'
browser.scroll.to :center
sleep 2


#marca
btn9 = browser.span(class: 'select2-selection__rendered')
btn10 = browser.text_field id: 'select2-search__field'
btn10.exists?
btn10.set ''
btn10.value
btn10.fire_event('onchange')



#(categoria)
btn11 = bbrowser.span(class: 'select2-selection__rendered')
btn11 = browser.text_field id: 'select2-search__field'
btn11.exists?
btn11.set ''
btn11.value
btn11.fire_event('onchange')
=end

browser.scroll.to :bottom

#loja
btn12 = browser.span(class: 'select2-selection__rendered').click
sleep 2
btn13 = browser.span(class: 'select2-search__field').click
btn14 = browser.text_field(class: 'select2-search__field')
btn14.exists?
btn14.set 'Mc donalds'
btn14.value
btn14.fire_event('onchange')
sleep 2
=begin
#btn14 = browser.li(id: 'select2-store-result-1sam-6').click
sleep 2

browser.screenshot.save 'Screenshot/Produto/CriarProduto/preenchendo_ct01.png'
sleep 2
browser.div.click

browser.scroll.to :class



sleep 2

browser.screenshot.save 'Screenshot/Produto/CriarProduto/preenchendo_ct01.png'
=end