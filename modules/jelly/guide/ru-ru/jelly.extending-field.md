# Расширение Jelly полей

Путём определения собственных объектов полей, которые наследуются от класса `Jelly_Field` или
одного из его производных, можно добавить дополнительные сценарии поведения поля модели.

Так ка квсе связи обрабатываются объектами полей, это даёт возможность определения собственной 
логики отношений между моделями. Заметьте, что для этого необходимо взглянуть на интерфейсы 
`Jelly_Field_Behavior_*`, которые позволяют полям определять то, что они могут использовать 
методы `with()`, `has()`, или `add()` и `remove()`.

Более подробная информация находится в [API документации](api/Jelly_Field_Behavior).