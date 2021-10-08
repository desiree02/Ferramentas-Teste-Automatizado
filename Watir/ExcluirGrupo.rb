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

#excluir grupo
btn1 = browser.li(id: 'mainGroupNav').click

sleep 2
btn2 = browser.li(:id => 'manageGroupNav').click
browser.window.maximize
browser.scroll.to :center
sleep 2
browser.screenshot.save 'Screenshot/Grupo/Exclusao/ExcluindoGrupos.png'

btn3 = browser.text_field(class: 'form-control input-sm')
btn3.exists?
#btn3.set 'desiree'
#btn3.set 'none'
#btn3.set 'rural'
#btn3.set 'globo'
#btn3.set 'ccomp'
#btn3.set 'ufrrj'
#btn3.set 'dcc'
btn3.value
btn3.fire_event('onchange')
browser.screenshot.save 'Screenshot/Grupo/Exclusao/SelecionandoGrupo_excluir_ct03.png'


browser.div.click
sleep 2

browser.screenshot.save 'Screenshot/Grupo/Exclusao/Excluindo_ct3.png'
sleep 2

btn4 = browser.link(:name => "delete").when_present.click
browser.screenshot.save 'Screenshot/Grupo/Exclusao/SelecionandoGrupo_ConfirmaExclusao_ct03.png'
sleep 2


#CONFIRM
btn7 = browser.button(name: 'confirm').wait_until(&:enabled?)
btn7.fire_event('onclick')
browser.screenshot.save 'Screenshot/Grupo/Exclusao/Excluindo_ct1.png'
sleep 2
browser.scroll.to :center
browser.screenshot.save 'Screenshot/Grupo/Exclusao/Excluido_ct1.png'


#CANCEL
#btn7 = browser.link(:class  => "btn btn-warning").when_present.click
#browser.screenshot.save 'Screenshot/Grupo/Exclusao/Excluindo_ct2.png'
#sleep 2
#browser.scroll.to :center
#browser.screenshot.save 'Screenshot/Grupo/Exclusao/Excluido_ct2.png'