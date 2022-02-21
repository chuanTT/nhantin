CREATE TABLE `user` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `first_name` varchar(255),
  `last_name` varchar(255),
  `userName` varchar(255),
  `password` varchar(255),
  `avatar` varchar(255),
  `deleted` boolean,
  `create_at` datetime,
  `update_at` datetime
);

CREATE TABLE `myfriend` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `idUser` int,
  `idFriend` int,
  `status` varchar(255),
  `block` boolean,
  `create_at` datetime,
  `update_at` datetime
);

CREATE TABLE `messeageFriends` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `idRoom` int,
  `idUser` int,
  `message_content` varchar(255)
);
