/*
  Warnings:

  - A unique constraint covering the columns `[title]` on the table `Step` will be added. If there are existing duplicate values, this will fail.

*/
-- CreateIndex
CREATE UNIQUE INDEX "Step_title_key" ON "Step"("title");
