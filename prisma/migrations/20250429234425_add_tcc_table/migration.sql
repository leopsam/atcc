-- AlterTable
ALTER TABLE "Theme" ADD COLUMN     "used" BOOLEAN NOT NULL DEFAULT false;

-- CreateTable
CREATE TABLE "Tcc" (
    "id" TEXT NOT NULL,
    "advisor" TEXT NOT NULL,
    "themeId" TEXT NOT NULL,
    "members" TEXT[],
    "createdAt" TIMESTAMP(3) NOT NULL DEFAULT CURRENT_TIMESTAMP,
    "updatedAt" TIMESTAMP(3) NOT NULL,

    CONSTRAINT "Tcc_pkey" PRIMARY KEY ("id")
);

-- AddForeignKey
ALTER TABLE "Tcc" ADD CONSTRAINT "Tcc_themeId_fkey" FOREIGN KEY ("themeId") REFERENCES "Theme"("id") ON DELETE RESTRICT ON UPDATE CASCADE;
