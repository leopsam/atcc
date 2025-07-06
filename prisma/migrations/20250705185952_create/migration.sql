-- CreateEnum
CREATE TYPE "StepStatus" AS ENUM ('OPEN', 'SUBMITTED', 'COMPLETED');

-- CreateTable
CREATE TABLE "Step" (
    "id" TEXT NOT NULL,
    "title" TEXT NOT NULL,
    "description" TEXT NOT NULL,
    "startDate" TIMESTAMP(3) NOT NULL,
    "endDate" TIMESTAMP(3) NOT NULL,
    "status" "StepStatus" NOT NULL DEFAULT 'OPEN',
    "fileUrl" TEXT NOT NULL,
    "createdAt" TIMESTAMP(3) NOT NULL DEFAULT CURRENT_TIMESTAMP,
    "updatedAt" TIMESTAMP(3) NOT NULL,
    "tccId" TEXT NOT NULL,

    CONSTRAINT "Step_pkey" PRIMARY KEY ("id")
);

-- AddForeignKey
ALTER TABLE "Step" ADD CONSTRAINT "Step_tccId_fkey" FOREIGN KEY ("tccId") REFERENCES "Tcc"("id") ON DELETE RESTRICT ON UPDATE CASCADE;
