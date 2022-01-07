ALTER TABLE `project_files` CHANGE `project_id` `project_id` INT(11) NOT NULL;
ALTER TABLE `activity_logs` CHANGE `project_id` `project_id` INT(11) NOT NULL;
ALTER TABLE `activity_logs` CHANGE `user_id` `user_id` INT(11) NOT NULL;

ALTER TABLE `users` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `workspaces` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `projects` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `tasks` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `comments` ADD CONSTRAINT fk_1 FOREIGN KEY (created_by) REFERENCES users(id);
ALTER TABLE `comments` ADD CONSTRAINT fk_2 FOREIGN KEY (task_id) REFERENCES tasks(id);

ALTER TABLE `projects` ADD CONSTRAINT fk_3 FOREIGN KEY (workspace) REFERENCES workspaces(id);
ALTER TABLE `milestones` ADD CONSTRAINT fk_4 FOREIGN KEY (project_id) REFERENCES projects(id);
ALTER TABLE `project_files` ADD CONSTRAINT fk_5 FOREIGN KEY (project_id) REFERENCES projects(id);
ALTER TABLE `activity_logs` ADD CONSTRAINT fk_6 FOREIGN KEY (project_id) REFERENCES projects(id);


ALTER TABLE `user_projects`  ADD CONSTRAINT fk_7 FOREIGN KEY (project_id) REFERENCES projects(id);
ALTER TABLE `user_projects`  ADD CONSTRAINT fk_8 FOREIGN KEY (user_id) REFERENCES users(id);

ALTER TABLE `sub_tasks`  ADD CONSTRAINT fk_9 FOREIGN KEY (created_by) REFERENCES users(id);
ALTER TABLE `sub_tasks`  ADD CONSTRAINT fk_10 FOREIGN KEY (task_id) REFERENCES tasks(id);

ALTER TABLE `tasks`ADD CONSTRAINT fk_11 FOREIGN KEY(project_id) REFERENCES projects(id);
ALTER TABLE `tasks`ADD CONSTRAINT fk_12 FOREIGN KEY(assign_to) REFERENCES users(id);

ALTER TABLE `task_files`ADD CONSTRAINT fk_13 FOREIGN KEY(created_by) REFERENCES users(id);

ALTER TABLE `todos` ADD CONSTRAINT fk_14 FOREIGN KEY(created_by) REFERENCES users(id);

ALTER TABLE `user_workspaces`  ADD CONSTRAINT fk_15 FOREIGN KEY (workspace_id) REFERENCES workspaces(id);
ALTER TABLE `user_workspaces`  ADD CONSTRAINT fk_16 FOREIGN KEY (user_id) REFERENCES users(id);

ALTER TABLE `users` ADD CONSTRAINT fk_17 FOREIGN KEY (current_workspace) REFERENCES workspaces(id);


ALTER TABLE `workspaces` ADD CONSTRAINT fk_18 FOREIGN KEY(created_by) REFERENCES users(id);
ALTER TABLE `activity_logs` ADD CONSTRAINT fk_19 FOREIGN KEY (user_id) REFERENCES users(id);


ALTER TABLE `notes` ADD CONSTRAINT fk_20 FOREIGN KEY(created_by) REFERENCES users(id);
ALTER TABLE `notes` ADD CONSTRAINT fk_21 FOREIGN KEY(workspace) REFERENCES workspaces(id);

ALTER TABLE `calendars` ADD CONSTRAINT fk_22 FOREIGN KEY(created_by) REFERENCES users(id);
ALTER TABLE `calendars` ADD CONSTRAINT fk_23 FOREIGN KEY(workspace) REFERENCES workspaces(id);

ALTER TABLE `events` ADD CONSTRAINT fk_24 FOREIGN KEY(created_by) REFERENCES users(id);
ALTER TABLE `events` ADD CONSTRAINT fk_25 FOREIGN KEY(workspace) REFERENCES workspaces(id);