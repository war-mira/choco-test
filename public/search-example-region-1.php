<?php

echo json_encode($respond = [
		[
			"text" => "Хирург",
			"count" => "15",
			"value" => "spec-1",
			"optgroup" => "Специализации"
		],
		[
			"text" => "Стоматолог",
			"count" => "5",
			"value" => "spec-2",
			"optgroup" => "Специализации"
		],
		[
			"text" => "Кардиолог",
			"count" => "12",
			"value" => "spec-3",
			"optgroup" => "Специализации"
		],
		[	
			"img" => "img/doc-extrasmall.jpg",
			"text" => "Иванов Иван Иванович",
			"spec" => "Андролог/Уролог",
			"value" => "doc-1",
			"optgroup" => "Врачи"
		],
		[
			"img" => "img/doc-extrasmall.jpg",
			"text" => "Иванов Иван Иванович",
			"spec" => "Хирург",
			"value" => "doc-2",
			"optgroup" => "Врачи"
		],
		[
			"img" => "img/doc-extrasmall.jpg",
			"text" => "Иванов Иван Иванович",
			"spec" => "Стоматолог",
			"value" => "doc-3",
			"optgroup" => "Врачи"
		]
]);