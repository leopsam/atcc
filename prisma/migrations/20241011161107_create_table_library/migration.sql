-- CreateEnum
CREATE TYPE "Type" AS ENUM ('VIDEO', 'BOOK');

-- CreateTable
CREATE TABLE "library" (
    "id" TEXT NOT NULL,
    "title" TEXT NOT NULL,
    "description" VARCHAR(100) NOT NULL,
    "type" "Type" NOT NULL,
    "image" TEXT NOT NULL,
    "file" TEXT NOT NULL,
    "createdAt" TIMESTAMP(3) NOT NULL DEFAULT CURRENT_TIMESTAMP,
    "updatedAt" TIMESTAMP(3) NOT NULL,

    CONSTRAINT "library_pkey" PRIMARY KEY ("id")
);

-- CreateIndex
CREATE UNIQUE INDEX "library_title_key" ON "library"("title");
