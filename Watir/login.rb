require 'watir'

browser = Watir::Browser.new :chrome
browser.goto('localhost/stock')

browser.screenshot.save 'Screenshot/Login/index.png'

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

browser.screenshot.save 'Screenshot/Login/login.png'

btn = browser.button(class: 'btn btn-primary btn-block btn-flat').wait_until(&:enabled?)
btn.fire_event('onclick')

browser.screenshot.save 'Screenshot/Login/pagInicial.png'