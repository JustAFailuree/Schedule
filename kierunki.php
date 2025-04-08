<!DOCTYPE html>
<html xmlns:th="http://www.thymeleaf.org">
<head>
    <title>Kierunki Studiów</title>
</head>
<body>
<h1>Lista kierunków</h1>

<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Nazwa Kierunku</th>
        <th>Rok</th>
        <th>Typ</th>
    </tr>
    </thead>
    <tbody>
    <tr th:each="kierunek : ${kierunki}">
        <td th:text="${kierunek.idKierunku}"></td>
        <td th:text="${kierunek.nazwaKierunku}"></td>
        <td th:text="${kierunek.rok}"></td>
        <td th:text="${kierunek.typ}"></td>
    </tr>
    </tbody>
</table>

</body>
</html>
