/*
  Warnings:

  - You are about to drop the column `registration` on the `User` table. All the data in the column will be lost.
  - A unique constraint covering the columns `[matriculation]` on the table `User` will be added. If there are existing duplicate values, this will fail.
  - Added the required column `matriculation` to the `User` table without a default value. This is not possible if the table is not empty.

*/
-- DropIndex
DROP INDEX "User_registration_key";

-- AlterTable
ALTER TABLE "User" DROP COLUMN "registration",
ADD COLUMN     "matriculation" TEXT NOT NULL;

-- CreateIndex
CREATE UNIQUE INDEX "User_matriculation_key" ON "User"("matriculation");
