/*
  Warnings:

  - You are about to drop the `library` table. If the table is not empty, all the data it contains will be lost.

*/
-- DropTable
DROP TABLE "library";

-- CreateTable
CREATE TABLE "Library" (
    "id" TEXT NOT NULL,
    "title" TEXT NOT NULL,
    "description" VARCHAR(100) NOT NULL,
    "type" "Type" NOT NULL,
    "image" TEXT NOT NULL,
    "file" TEXT NOT NULL,
    "createdAt" TIMESTAMP(3) NOT NULL DEFAULT CURRENT_TIMESTAMP,
    "updatedAt" TIMESTAMP(3) NOT NULL,

    CONSTRAINT "Library_pkey" PRIMARY KEY ("id")
);

-- CreateIndex
CREATE UNIQUE INDEX "Library_title_key" ON "Library"("title");
