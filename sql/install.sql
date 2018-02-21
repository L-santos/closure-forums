
INSERT INTO `status` (`id`, `value`) VALUES (1, 'APPROVED');
INSERT INTO `status` (`id`, `value`) VALUES (2, 'PENDING');
INSERT INTO `status` (`id`, `value`) VALUES (3, 'BLOCKED');

INSERT INTO `user_status` (`id`, `value`) VALUES (1, 'ACTIVE');
INSERT INTO `user_status` (`id`, `value`) VALUES (2, 'INACTIVE');
INSERT INTO `user_status` (`id`, `value`) VALUES (3, 'BLOCKED');

--

INSERT INTO `forum` (`name`, `slug`, `description`, `created_at`, `published`)
VALUES ('Your first forum', 'first-forum', 'Your first forum description', now(), true);

INSERT INTO `thread` (`status_id`, `user_id`, `forum_id`, `subject`, `reported`, `created_at`, `closed`, `views`)
VALUES (1, 1, 1, 'Whats next', 0, now(), 0, 0);

INSERT INTO `post` (`user_id`, `thread_id`, `status_id`, `reported`, `created_at`, `content`)
VALUES (1, 1, 1, 0, now(), 'Access the control panel and start creating new forums');

